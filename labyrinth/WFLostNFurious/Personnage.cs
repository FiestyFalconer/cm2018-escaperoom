using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WFLostNFurious
{
    class Personnage
    {
        //Propriete
        enum Direction { Haut, Bas, Gauche, Droite};

        PointF position;
        PointF positionDepart;
        int orientation;

        //Champs
        public PointF Position { get => position; set => position = value; }
        public int Orientation { get => orientation; set => orientation = value; }
        public PointF PositionDepart { get => positionDepart; set => positionDepart = value; }

        //Contructeur
        public Personnage(PointF position , int orientation)
        {
            // Initialisation des variables d'instances
            this.Position = position;
            this.Orientation = orientation;

            this.Position = new PointF(position.X, position.Y);
        }

        //Methodes
        /// <summary>
        /// Tourne le personnage vers la droite
        /// </summary>
        public void PivoterDroite()
        {
            switch (Orientation)
            {
                case (int)Direction.Gauche:
                    Orientation = (int)Direction.Haut;
                    break;
                case (int)Direction.Droite:
                    Orientation = (int)Direction.Bas;
                    break;
                case (int)Direction.Bas:
                    Orientation = (int)Direction.Gauche;
                    break;
                case (int)Direction.Haut:
                    Orientation = (int)Direction.Droite;
                    break;
            }
        }

        /// <summary>
        /// Tourne le personnage vers la gauche
        /// </summary>
        public void PivoterGauche()
        {
            switch (Orientation)
            {
                case (int)Direction.Gauche:
                    Orientation = (int)Direction.Bas;
                    break;
                case (int)Direction.Droite:
                    Orientation = (int)Direction.Haut;
                    break;
                case (int)Direction.Bas:
                    Orientation = (int)Direction.Droite;
                    break;
                case (int)Direction.Haut:
                    Orientation = (int)Direction.Gauche;
                    break;
            }
        }

        /// <summary>
        /// Fait avancer le personnage
        /// </summary>
        public void Avancer()
        {
            switch (Orientation)
            {
                case (int)Direction.Gauche:
                    this.Position = new PointF(Position.X - Jeu.TAILLE_BLOC_X, Position.Y);
                    break;
                case (int)Direction.Droite:
                    this.Position = new PointF(Position.X + Jeu.TAILLE_BLOC_X, Position.Y);
                    break;
                case (int)Direction.Bas:
                    this.Position = new PointF(Position.X, Position.Y + Jeu.TAILLE_BLOC_Y);
                    break;
                case (int)Direction.Haut:
                    this.Position = new PointF(Position.X, Position.Y - Jeu.TAILLE_BLOC_Y);
                    break;
            }
        }

        public void Respawn()
        {
            position = PositionDepart;
            orientation = (int)Direction.Haut;
        }
    }
}
