<?php
/**
 * includes/class.compte_vote.php
 */

/**
 * Class compte_vote
 *
 * Gère les objets BDD de la table compte_vote
 */
class compte_vote
{
    var $compte_vote_cod;
    var $compte_vote_total_px_gagner = 0;
    var $compte_vote_nbr;
    var $compte_vote_compte_cod;

    function __construct()
    {
    }

    /**
     * Stocke l'enregistrement courant dans la BDD
     * @global bdd_mysql $pdo
     * @param boolean $new => true si new enregistrement (insert), false si existant (update)
     */
    function stocke($new = false)
    {
        $pdo = new bddpdo;
        if ($new)
        {
            $req  = "insert into compte_vote (
            compte_vote_total_px_gagner,
            compte_vote_nbr,
            compte_vote_compte_cod                        )
                    values
                    (
                        :compte_vote_total_px_gagner,
                        :compte_vote_nbr,
                        :compte_vote_compte_cod                        )
    returning compte_vote_cod as id";
            $stmt = $pdo->prepare($req);
            $stmt = $pdo->execute(array(
                ":compte_vote_total_px_gagner" => $this->compte_vote_total_px_gagner,
                ":compte_vote_nbr" => $this->compte_vote_nbr,
                ":compte_vote_compte_cod" => $this->compte_vote_compte_cod,
            ), $stmt);


            $temp = $stmt->fetch();
            $this->charge($temp['id']);
        }
        else
        {
            $req  = "update compte_vote
                    set
            compte_vote_total_px_gagner = :compte_vote_total_px_gagner,
            compte_vote_nbr = :compte_vote_nbr,
            compte_vote_compte_cod = :compte_vote_compte_cod                        where compte_vote_cod = :compte_vote_cod ";
            $stmt = $pdo->prepare($req);
            $stmt = $pdo->execute(array(
                ":compte_vote_cod" => $this->compte_vote_cod,
                ":compte_vote_total_px_gagner" => $this->compte_vote_total_px_gagner,
                ":compte_vote_nbr" => $this->compte_vote_nbr,
                ":compte_vote_compte_cod" => $this->compte_vote_compte_cod,
            ), $stmt);
        }
    }

    /**
     * Charge dans la classe un enregistrement de compte_vote
     * @global bdd_mysql $pdo
     * @param integer $code => PK
     * @return boolean => false si non trouvé
     */
    function charge($code)
    {
        $pdo  = new bddpdo;
        $req  = "select * from compte_vote where compte_vote_cod = ?";
        $stmt = $pdo->prepare($req);
        $stmt = $pdo->execute(array($code), $stmt);
        if (!$result = $stmt->fetch())
        {
            return false;
        }
        $this->compte_vote_cod             = $result['compte_vote_cod'];
        $this->compte_vote_total_px_gagner = $result['compte_vote_total_px_gagner'];
        $this->compte_vote_nbr             = $result['compte_vote_nbr'];
        $this->compte_vote_compte_cod      = $result['compte_vote_compte_cod'];
        return true;
    }

    /**
     * Retourne un tableau de tous les enregistrements
     * @global bdd_mysql $pdo
     * @return \compte_vote
     */
    function getAll()
    {
        $retour = array();
        $pdo    = new bddpdo;
        $req    = "select compte_vote_cod  from compte_vote order by compte_vote_cod";
        $stmt   = $pdo->query($req);
        while ($result = $stmt->fetch())
        {
            $temp = new compte_vote;
            $temp->charge($result["compte_vote_cod"]);
            $retour[] = $temp;
            unset($temp);
        }
        return $retour;
    }

    public function __call($name, $arguments)
    {
        switch (substr($name, 0, 6))
        {
            case 'getBy_':
                if (property_exists($this, substr($name, 6)))
                {
                    $retour = array();
                    $pdo    = new bddpdo;
                    $req    = "select compte_vote_cod  from compte_vote where " . substr($name, 6) . " = ? order by compte_vote_cod";
                    $stmt   = $pdo->prepare($req);
                    $stmt   = $pdo->execute(array($arguments[0]), $stmt);
                    while ($result = $stmt->fetch())
                    {
                        $temp = new compte_vote;
                        $temp->charge($result["compte_vote_cod"]);
                        $retour[] = $temp;
                        unset($temp);
                    }
                    if (count($retour) == 0)
                    {
                        return false;
                    }
                    return $retour;
                }
                else
                {
                    die('Unknown variable ' . substr($name,6));
                }
                break;

            default:
                die('Unknown method.');
        }
    }
}