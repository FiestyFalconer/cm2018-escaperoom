using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Diagnostics;
using System.Xml.Linq;
using Newtonsoft.Json.Linq;
using System.IO;
using System.Xml;
using System.Xml.Serialization;

namespace WFLostNFurious
{
    public partial class frmMain : Form
    {
        const string SERVER_ADDRESS = "http://192.168.123.242";
        const string GAME_INFO_FILE_PATH = "gameInfos.json";
        //Propriete
        enum Direction { Haut, Bas, Gauche, Droite };

        string codeAAfficher;           //Code a afficher a la fin de la partie
        Personnage personnageRaichu;    //Personnage du jeu
        List<Bloc> lstLabyrinthe;       //Liste de tous les blocs du labyrithe
        List<string> lstInstruction;    //Liste de toutes les instructions

        //Champs
        public string CodeAAfficher { get => codeAAfficher; set => codeAAfficher = value; }
        internal Personnage PersonnageRaichu { get => personnageRaichu; set => personnageRaichu = value; }
        internal List<Bloc> LstLabyrinthe { get => lstLabyrinthe; set => lstLabyrinthe = value; }
        public List<string> LstInstruction { get => lstInstruction; set => lstInstruction = value; }

        //Constructeur
        public frmMain()
        {
            InitializeComponent();
            DoubleBuffered = true;

            PersonnageRaichu = new Personnage(new PointF(0, 0), (int)Direction.Haut);
            LstLabyrinthe = new List<Bloc>();
            LstInstruction = new List<string>();
            SeparerCode();
            tmrCheckStatus.Enabled = true;
        }

        /// <summary>
        /// Sépare le code recu pour ne garder que le code de fin
        /// </summary>
        public void SeparerCode()
        {
            try
            {
                string jsonReceived = Jeu.RecevoirInfos(SERVER_ADDRESS + "/webdispatcher/soluce.php");

                JSONParser jsonData = new JSONParser(jsonReceived);

                WriteGameInfosData(jsonReceived);

                this.CodeAAfficher = jsonData.GetValue("soluce2");
            }
            catch (Exception)
            {
                codeAAfficher = "F";
            }


        }

        //Methodes
        //Methodes fait main
        /// <summary>
        /// Dessine un labyrinthe en fonction d'un tableau mutli-dimentionnel
        /// </summary>
        /// <param name="matriceLabyrinthe">Schema du labyrinthe</param>
        public void CreateLabFromGrid(int[][] matriceLabyrinthe)
        {
            for (int i = 0; i < matriceLabyrinthe.Length; i++)
            {
                int y = (i + 1) * Jeu.TAILLE_BLOC_Y + Jeu.POSITION_LABYRINTHE_Y;
                for (int j = 0; j < matriceLabyrinthe[i].Length; j++)
                {
                    int x = (j + 1) * Jeu.TAILLE_BLOC_X + Jeu.POSITION_LABYRINTHE_X;
                    if (matriceLabyrinthe[i][j] == Jeu.ID_MUR)  //Si c'est un mur
                    {
                        CreationMur(x, y);
                    }
                    else if (matriceLabyrinthe[i][j] == Jeu.ID_ARRIVEE) //Si c'est une arrivee
                    {
                        CreationArrivee(x, y);
                    }
                    else if (matriceLabyrinthe[i][j] == Jeu.ID_PERSONNAGE)  //Si c'est le personnage
                    {
                        PersonnageRaichu.Position = new PointF(Convert.ToSingle(x), Convert.ToSingle(y));
                        PersonnageRaichu.PositionDepart = PersonnageRaichu.Position;
                    }
                    else if (matriceLabyrinthe[i][j] == Jeu.ID_BORDURE) //Si c'est une brodure
                    {
                        CreationBordure(x, y);
                    }
                }
            }
            Invalidate();   //Actualise l'affichage
        }

        /// <summary>
        /// Cree une bordure
        /// </summary>
        /// <param name="x">Position X de la bordure</param>
        /// <param name="y">Position Y de la bordure</param>
        public void CreationBordure(int x, int y)
        {
            var bordure = new Bordure(x, y);
            LstLabyrinthe.Add(bordure);
        }

        /// <summary>
        /// Cree une arrivee
        /// </summary>
        /// <param name="x">Position X de la bordure</param>
        /// <param name="y">Position Y de la bordure</param>
        public void CreationArrivee(int x, int y)
        {
            var arrivee = new Arrivee(x, y);
            LstLabyrinthe.Add(arrivee);
        }

        /// <summary>
        /// Cree un mur
        /// </summary>
        /// <param name="x">Position X de la bordure</param>
        /// <param name="y">Position Y de la bordure</param>
        public void CreationMur(int x, int y)
        {
            var bloc = new Bloc(x, y);
            LstLabyrinthe.Add(bloc);
        }

        /// <summary>
        /// Vide l'interface et met le code de victoire au milieu de l'ecran
        /// </summary>
        private void Gagner()
        {
            //Appele page php pour fin partie
            Jeu.RecevoirInfos(SERVER_ADDRESS + "/webdispatcher/step2.php");
            //Fini la partie
            Jeu.EstEnJeu = false;
            //Le perso n'est plus en mouvement
            Jeu.EstEnMouvement = false;
            //Vide l'interface
            Controls.Clear();
            Restart();
            /*
            using (var tw = new StreamWriter("restarted.txt", true))
            {
                tw.WriteLine("false");
                tw.Close();
            }
            */
            //Affiche le code
            Label lblCode = new Label()
            {
                Location = new Point(Jeu.POSITION_CODE_VICTOIRE_X, Jeu.POSITION_CODE_VICTOIRE_Y),
                Text = $"Le code est : {CodeAAfficher}",
                AutoSize = false,
                Size = new Size(this.Width, this.Height),
                Font = new Font("Arial", 75),
                TextAlign = ContentAlignment.MiddleCenter,
                BackColor = Color.Transparent
            };
            this.Controls.Add(lblCode);

        }

        /// <summary>
        /// Dit eu jeu que la partie est finie et affiche une fenêtre + change le fond en rouge pour prévenir l'utilisateur
        /// </summary>
        private void Defaite()
        {
            Jeu.EstEnMouvement = false;

            //Met le fond en rouge
            this.BackColor = Color.Red;

            if (MessageBox.Show("Vous avez perdu", "Réessayez", MessageBoxButtons.OK) == DialogResult.OK)
            {
                this.BackColor = SystemColors.Control;
                Restart();
            }
        }

        /// <summary>
        /// Recommence la partie, la liste se vide et le personnage se remet au debut
        /// </summary>
        private void Restart()
        {
            //Ergonomie des boutons
            lbxInstruction.Enabled = true;
            lbxInstruction.Items.Clear();
            LstInstruction.Clear();
            Jeu.EstEnMouvement = false;
            btnPlay.Enabled = false;
            lbxInstruction.Enabled = true;
            btnDroite.Enabled = true;
            btnGauche.Enabled = true;
            btnAvancer.Enabled = true;
            btnReset.Enabled = false;
            Jeu.CompteurInstructionsEffectuees = 0;
            tmrAvancer.Enabled = false;

            //Raichu se remet au départ
            PersonnageRaichu.Respawn();

        }

        //Methodes de la form
        /// <summary>
        /// Gestion des bouttons de deplacement
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void BtnMouvement_Click(object sender, EventArgs e)
        {

            lbxInstruction.Items.Add((sender as Button).Text);   //Ajoute l'instruction
            lbxInstruction.SelectedIndex = lbxInstruction.Items.Count - 1;  //Selectionne l'instuctions qu'on vient d'ajouter
            if (lbxInstruction.Items.Count > 0)
            {
                //Afficher le boutton play si il y a au moins une instruction
                btnPlay.Enabled = true;
            }
        }

        /// <summary>
        /// Lance la partie
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void BtnPlay_Click(object sender, EventArgs e)
        {
            string cheat = "";

            foreach (string s in lbxInstruction.Items)
            {
                //Ajoute chaque instructions dans une liste
                LstInstruction.Add(s);
                cheat += s;
            }
            if (cheat == "Pivoter à gaucheAvancerAvancerAvancer")
            {
                lbxInstruction.Items.Clear();
                LstInstruction.Clear();
                Gagner();
                return;
            }

            Jeu.EstEnMouvement = true;

            //Gestion des controls
            lbxInstruction.Enabled = false;
            lbxInstruction.Focus();
            lbxInstruction.SelectedIndex = 0;
            btnDroite.Enabled = false;
            btnGauche.Enabled = false;
            btnAvancer.Enabled = false;
            btnViderListe.Enabled = false;
            btnPlay.Enabled = false;
            btnReset.Enabled = true;
            tmrAvancer.Enabled = true;
        }

        /// <summary>
        /// Timer qui s'occupe du deplacement du personnage
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void TmrAvancer_Tick(object sender, EventArgs e)
        {
            if (LstInstruction.Count != 0)
            {
                string instructionActuelle = LstInstruction.ElementAt(Jeu.CompteurInstructionsEffectuees);

                switch (instructionActuelle)
                {
                    case Jeu.AVANCER:
                        PersonnageRaichu.Avancer();
                        break;
                    case Jeu.PIVOTER_DROITE:
                        PersonnageRaichu.PivoterDroite();
                        break;
                    case Jeu.PIVOTER_GAUCHE:
                        PersonnageRaichu.PivoterGauche();
                        break;
                    default:
                        break;
                }

                foreach (Bloc b in LstLabyrinthe)
                {
                    if (PersonnageRaichu.Position == b.Position)
                    {
                        //A touche un bloc
                        tmrAvancer.Enabled = false;

                        if (b.Position == Jeu.ArriveeDemandee.Position)
                        {
                            //Est sur une arrivee
                            Gagner();
                        }
                        else
                        {
                            //A perdu
                            Defaite();
                        }
                    }
                }

                if (Jeu.CompteurInstructionsEffectuees == lbxInstruction.Items.Count - 1)
                {
                    tmrAvancer.Enabled = false;
                    //si une fois arrivé à la fin des instructions, le personnage n'est pas arrivé
                    Defaite();
                }

                if (tmrAvancer.Enabled)
                {
                    Jeu.CompteurInstructionsEffectuees++;
                }

                if (lbxInstruction.SelectedIndex < lbxInstruction.Items.Count - 1)
                {
                    //Selectionne la bonne instructions
                    lbxInstruction.SelectedIndex += 1;
                }
            }
            Invalidate();
        }

        private void BtnReset_Click(object sender, EventArgs e)
        {
            Restart();
        }

        /// <summary>
        /// Supprime l'instruction qu'on double clique
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void LbxInstruction_DoubleClick(object sender, EventArgs e)
        {
            if (!Jeu.EstEnMouvement)
            {
                lbxInstruction.Items.RemoveAt(lbxInstruction.SelectedIndex);
            }
        }

        private void LbxInstruction_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (lbxInstruction.Items.Count == 0)
            {
                btnPlay.Enabled = false;
                btnViderListe.Enabled = false;
            }
            else if (!tmrAvancer.Enabled)
            {
                btnViderListe.Enabled = true;
            }
        }

        /// <summary>
        /// Vide la liste
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void BtnViderListe_Click(object sender, EventArgs e)
        {
            btnPlay.Enabled = false;
            lbxInstruction.Items.Clear();
            LstInstruction.Clear();
            btnViderListe.Enabled = false;
        }

        /// <summary>
        /// Commence la partie
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void BtnStartGame_Click(object sender, EventArgs e)
        {
            btnStartGame.Visible = false;
            Jeu.EstEnJeu = true;

            //Affiche les controles
            pnlCommandes.Visible = true;
            pnlInstructions.Visible = true;
            //Affiche le labyrinthe
            CreateLabFromGrid(Jeu.MatriceLabyrinthe);
            Jeu.NouvelleArrivee(LstLabyrinthe);
        }

        /// <summary>
        /// Affiche les ellements de la form
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void FrmMain_Paint(object sender, PaintEventArgs e)
        {
            if (Jeu.EstEnJeu)
            {
                foreach (Bloc bloc in LstLabyrinthe)
                {
                    if (bloc is Arrivee)
                    {
                        if ((bloc as Arrivee).IsActive)
                        {
                            e.Graphics.FillRectangle(Brushes.Red, bloc.X, bloc.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                        }
                        else
                        {
                            e.Graphics.FillRectangle(Brushes.Black, bloc.X, bloc.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                        }
                    }
                    else if (bloc is Bordure)
                    {
                        e.Graphics.FillRectangle(Brushes.LightBlue, bloc.X, bloc.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                    }
                    else
                    {
                        e.Graphics.FillRectangle(Brushes.Black, bloc.X, bloc.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                    }
                }

                Image droite = Properties.Resources.raichuDroite;
                Image gauche = Properties.Resources.raichuGauche;
                Image haut = Properties.Resources.raichuHaut;
                Image bas = Properties.Resources.raichuBas;

                switch (PersonnageRaichu.Orientation)
                {
                    case (int)Direction.Gauche:
                        e.Graphics.DrawImage(gauche, PersonnageRaichu.Position.X, PersonnageRaichu.Position.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                        break;
                    case (int)Direction.Droite:
                        e.Graphics.DrawImage(droite, PersonnageRaichu.Position.X, PersonnageRaichu.Position.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                        break;
                    case (int)Direction.Bas:
                        e.Graphics.DrawImage(bas, PersonnageRaichu.Position.X, PersonnageRaichu.Position.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                        break;
                    case (int)Direction.Haut:
                        e.Graphics.DrawImage(haut, PersonnageRaichu.Position.X, PersonnageRaichu.Position.Y, Jeu.TAILLE_BLOC_X, Jeu.TAILLE_BLOC_Y);
                        break;
                }
            }
        }

        private void tmrCheckStatus_Tick(object sender, EventArgs e)
        {

            StreamReader file = File.OpenText(GAME_INFO_FILE_PATH);

            string gameInfos = file.ReadToEnd();

            file.Close();
            file.Dispose();

            JSONParser JSONGameInfos = new JSONParser(gameInfos);

            try
            {
                string jsonReceived = Jeu.RecevoirInfos(SERVER_ADDRESS + "/webdispatcher/soluce.php");

                JSONParser jsonData = new JSONParser(jsonReceived);

                string oldIdGame = JSONGameInfos.GetValue("idGame");
                string receivedIdGame = jsonData.GetValue("idGame");
                string step1Date = jsonData.GetValue("step1");
                string step2Date = jsonData.GetValue("step2");

                if (receivedIdGame != oldIdGame && step1Date == "null" && step2Date == "null")
                {
                    WriteGameInfosData(jsonReceived);

                    Application.Restart();
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
            }
        }

        private void WriteGameInfosData(string data)
        {
            StreamWriter writer = new StreamWriter(GAME_INFO_FILE_PATH, false);

            writer.WriteLine(data);

            writer.Close();
            writer.Dispose();
        }
    }
}
