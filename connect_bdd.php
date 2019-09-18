<?php

class connect_bdd{
          protected function dbconnect(){
                    $bdd = new PDO('mysql:host=localhost;dbname=Pharmacetica' ,'sserver', 'sserver') or die ('Not connected');
                    return $bdd;
          }
}
class Query_bdd extends connect_bdd{

        public function verification($usr, $mdp) {
                $bdd = $this->dbconnect();
                $verifier = $bdd->prepare("SELECT 1 from Admin_admin where username = ? and passwd = ?");
                $verifier->execute(array($usr, $mdp));
                return $verifier->rowCount();
        }
        public function insertion($ref,  $nom, $nbr, $puni) {
                $bdd = $this->dbconnect();
                $ajouter =  $bdd->prepare( "INSERT INTO produit(id, nom, prix_unit, nombre) values(? , ? , ? , ?)");
                $ajouter->execute(array($ref, $nom, $puni, $nbr));
                return $ajouter;
        }
        public function misintona() {
                $bdd = $this->dbconnect();
                $misintona_fanafody =  $bdd->query( "SELECT  id, nom, prix_unit, nombre_commande, nombre from produit");
                return $misintona_fanafody;
        }
        public function mamafa($id) {
                $bdd = $this->dbconnect();
                $mamafa_fanafody =  $bdd->query( "DELETE from produit where id= '$id' ");
                return $mamafa_fanafody;
        }
        public function verif_refana($id, $nom){
                $bdd = $this->dbconnect();
                $verif_refana =  $bdd->query("SELECT 1 from produit WHERE id = '$id' or nom = '$nom' ");
                return  $verif_refana;
        }
        public function hanova_fanafody($id, $nbr, $puni){
                $bdd = $this->dbconnect();
                $hanov_f =  $bdd->query("UPDATE produit SET  nombre='$nbr', prix_unit='$puni' WHERE id = '$id' ");
                return  $hanov_f;
        }
        public function recherche($nom){
              $bdd = $this->dbconnect();
              $mitady =  $bdd->query("SELECT nom, prix_unit from produit WHERE  nom LIKE  '%$nom%' ");
              return  $mitady;
        }
        public function ijery_fanafody(){
                $bdd = $this->dbconnect();
                $ijery =  $bdd->query("SELECT nom from produit ");
                return  $ijery;
        }

        public function ijery_user($nom, $prenom, $cin){

                $bdd = $this->dbconnect();
                $ijery =  $bdd->query("SELECT 1 FROM Client WHERE nom = '$nom' AND prenom = '$prenom' AND cin='$cin' ");
                $nbr = $ijery->rowCount();
                return  $nbr;
        }

        public function hamandrika($an_mp, $fan_mp, $kara_mp, $adr_mp, $find_mp, $an_fn, $isa_fn){

                $mis = $this->ijery_user($an_mp, $fan_mp, $kara_mp);
                $bdd = $this->dbconnect();
                if ($mis == 0){
                  $bdd->query("INSERT INTO Client(nom, prenom, cin, adresse, telephone) VALUES ('$an_mp', '$fan_mp', '$kara_mp', '$adr_mp', '$find_mp') ") or die("Oups");
                }

                $code = time();

                $bdd->query("INSERT INTO Commande(Numero, produit_name, nbr_produit, client_id) VALUES ('$code', '$an_fn', '$isa_fn', '$kara_mp') ");

                return  $code;
        }
}
