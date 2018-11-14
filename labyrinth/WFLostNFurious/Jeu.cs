using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace WFLostNFurious
{
    static class Jeu
    {
        //Propriete
        #region const
        public const int ID_MUR = 1;
        public const int ID_ARRIVEE = 2;
        public const int ID_PERSONNAGE = 3;
        public const int ID_BORDURE = 4;

        public const string AVANCER = "Avancer";
        public const string PIVOTER_GAUCHE = "Pivoter à gauche";
        public const string PIVOTER_DROITE = "Pivoter à droite";

        public const int POSITION_LABYRINTHE_X = 450;
        public const int POSITION_LABYRINTHE_Y = 10;
        public const int NOMBRE_SORTIES = 3;
        public const int DUREE_UNE_SECONDE_EN_MS = 1000;
        public const int POSITION_CODE_VICTOIRE_X = 0;
        public const int POSITION_CODE_VICTOIRE_Y = -10;

        public const int CODE_MIN = 10;
        public const int CODE_MAX = 50;

        public const int TAILLE_BLOC_X = 70;
        public const int TAILLE_BLOC_Y = 70;

        public const string CODE_DE_BASE = "F";
        #endregion

        #region Propriete
        static bool estEnJeu;
        static bool estEnMouvement;
        static Bloc arriveeDemandee;
        static Random rnd;
        static readonly int[][] matriceLabyrinthe;  //Matrice du labyrinthe
        static int compteurInstructionsEffectuees;
        #endregion

        //Champs
        #region Champs
        /// <summary>
        /// True si la partie est en cours
        /// </summary>
        public static bool EstEnJeu { get => estEnJeu; set => estEnJeu = value; }
        /// <summary>
        /// True si le personnage est entrain de faire les actions
        /// </summary>
        static public bool EstEnMouvement { get => estEnMouvement; set => estEnMouvement = value; }
        /// <summary>
        /// Arrivee a laquelle le joueur doit se rendre
        /// </summary>
        static public Bloc ArriveeDemandee { get => arriveeDemandee; set => arriveeDemandee = value; }
        /// <summary>
        /// Random du programme
        /// </summary>
        public static Random Rnd { get => rnd; set => rnd = value; }
        /// <summary>
        /// Tableau qui contient le schema du labyrithe
        /// </summary>
        public static int[][] MatriceLabyrinthe => matriceLabyrinthe;
        /// <summary>
        /// Nombre d'instructions effectuee par le personnage
        /// </summary>
        public static int CompteurInstructionsEffectuees { get => compteurInstructionsEffectuees; set => compteurInstructionsEffectuees = value; } 
        #endregion

        //Constructeur
        static Jeu()
        {
            EstEnJeu = false;
            EstEnMouvement = false;
            ArriveeDemandee = new Arrivee();
            Rnd = new Random();
            matriceLabyrinthe = new int[][] {
                new int[] { 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4 },
                new int[] { 4, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 4 },
                new int[] { 4, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 4 },
                new int[] { 4, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 4 },
                new int[] { 4, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 4 },
                new int[] { 4, 1, 1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 4 },
                new int[] { 4, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 2, 4 },
                new int[] { 4, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 4 },
                new int[] { 4, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 4 },
                new int[] { 4, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 4 },
                new int[] { 4, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 4 },
                new int[] { 4, 1, 1, 1, 1, 1, 3, 1, 1, 1, 1, 1, 4 },
                new int[] { 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4 }
            };
            CompteurInstructionsEffectuees = 0;
        }

        //Methodes
        #region Methodes
        /// <summary>
        /// Definit la nouvelle arrivee a atteindre
        /// </summary>
        /// <param name="lstLabyrinthe">Tableau du labyrithe</param>
        static public void NouvelleArrivee(List<Bloc> lstLabyrinthe)
        {
            int valArrive = Rnd.Next(Jeu.NOMBRE_SORTIES);   //Numero de l'arrivee choisie
            int compteurSortie = 0;   //Compteur qui sert a savoir sur quelle arrivee on est

            //Regarde chaque bloc du labyrinthe
            foreach (Bloc m in lstLabyrinthe)
            {
                if (m is Arrivee)
                {
                    if (valArrive == compteurSortie) //Prend une arrivee aleatoirement et la met dans une variable pour s'en souvenir
                    {
                        arriveeDemandee = m;
                        (arriveeDemandee as Arrivee).IsActive = true;
                    }
                    compteurSortie++;
                }
            }
        }

        /// <summary>
        /// Recoit le code à afficher à la fin depuis le serveur
        /// </summary>
        /// <param name="url">Url du serveur</param>
        /// <returns>Le code si connexion reussie, F sinon</returns>
        static public string RecevoirInfos(string url)
        {
            string code = "";  //La pour le debuggage
            try
            {
                using (WebClient client = new WebClient())
                {
                    code = client.DownloadString(new Uri(url));
                    return code;
                }
            }
            catch (WebException e)
            {
                Debug.WriteLine(e.ToString());
                return Jeu.CODE_DE_BASE;
            }
        } 
        #endregion
    }
}
