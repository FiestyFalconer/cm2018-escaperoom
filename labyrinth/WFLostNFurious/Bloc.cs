using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WFLostNFurious
{
    
    class Bloc
    {
        //Propriete
        int x;
        int y;

        //Champs
        public int X { get => x; set => x = value; }
        public int Y { get => y; set => y = value; }
        public PointF Position { get => new PointF((float)X, (float)Y); }

        //Constructeurs
        public Bloc() : this(10, 10)
        {

        }

        public Bloc(int x, int y)
        {
            this.X = x;
            this.Y = y;
        }

        //Methodes
    }

    

    
}
