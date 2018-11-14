using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WFLostNFurious
{
    class Arrivee : Bloc
    {
        //Propriete
        bool isActive;

        //Champs
        public bool IsActive { get => isActive; set => isActive = value; }

        //Constructeurs
        public Arrivee() : this(10, 10)
        {

        }

        public Arrivee(int x, int y) : base(x, y)
        {
            IsActive = false;
        }
        
        //Methodes
    }
}
