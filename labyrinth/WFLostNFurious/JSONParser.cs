using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml;
using System.Xml.Serialization;

namespace WFLostNFurious
{
    public class JSONParser
    {
        private Dictionary<string, string> dictionary;

        private Dictionary<string, string> Dictionary { get => dictionary; set => dictionary = value; }

        public JSONParser(string json)
        {
            this.Dictionary = new Dictionary<string, string>();

            string newJson = json.Replace("{", "").Replace("}", "");

            string[] data = newJson.Split(',');

            foreach (var obj in data)
            {
                string[] field = obj.Split(':');

                string key = field[0].Replace("\"","");
                string value = field[1].Replace("\"", "");

                this.Dictionary.Add(key, value);
            }
        }

        public string GetValue(string key)
        {
            if (this.Dictionary.Keys.Contains(key))
            {
                return this.Dictionary[key];
            } else
            {
                return "";
            }
        }
    }
}
