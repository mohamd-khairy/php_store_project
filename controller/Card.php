<?php

class Card {

    private $template;
    private $ca;
    private $sc;

    public function __construct() {
        $this->template = new Template();
        $this->ca = new CardModel();
        $this->sc = new SellcardModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function checkcardAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $currentCard = CardModel::value_in_or_not($_POST['sc_net'], $_POST['sc_value']);
            if (!empty($currentCard)) {
                $currentCard = $currentCard[0];
            }
            if ($_POST['sc_num'] > $currentCard['ca_num']) {
                echo ' عدد الكروت المتاحه  ' . $currentCard['ca_num'];
                die();
            } else {
                echo 'true';
                die();
            }
        }
    }

    function sellAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $cardData = CardModel::value_in_or_not($_POST['sc_net'], $_POST['sc_value']);
            if (!empty($cardData)) {
                $cardData = $cardData[0];
            }
            $this->sc->sc_net = $_POST['sc_net'];
            $this->sc->sc_num = $_POST['sc_num'];
            $this->sc->sc_mony = $_POST['sc_mony'];
            $this->sc->sc_value = $_POST['sc_value'];
            $this->sc->sc_datetime = date(DateTime::ATOM);
            if ($this->sc->insert() >= 1) {
                $this->ca->ca_id = $cardData['ca_id'];
                $this->ca->ca_cost = $cardData['ca_cost1'];
                $this->ca->ca_price = $cardData['ca_price1'];
                $net = $this->ca->ca_net = $cardData['ca_net'];
                $this->ca->ca_num = $cardData['ca_num'] - $_POST['sc_num'];
                $this->ca->ca_datetime = $cardData['ca_datetime'];
                $v = $this->ca->ca_value = $cardData['ca_value'];
                if ($this->ca->updatecard($net, $v) >= 1) {
                    echo 'true';
                    die();
                } else {
                    echo 'false';
                    die();
                }
            }
        }
        $this->template->render('card/sell_card');
    }

    function showAction() {
        $this->template->render('card/show');
    }

    function addAction() {
        $this->template->render('card/add');
    }

    function getcardnumAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {

            $cards = CardModel::get_cards($_POST['sc_net']);
            foreach ($cards as $ca) {
                $c[] = $ca['ca_value'];
            }
            $result = array_unique($c);
            foreach ($result as $key => $r) {
                $emptyCard = CardModel::value_in_or_not($_POST['sc_net'], $r);
                if ($emptyCard[0]['ca_num'] == 0) {
                    unset($result[$key]);
                }
            }
            $_SESSION['data'] = $result;
            $_SESSION['net'] = $_POST['sc_net'];
        }
    }

    function newAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $this->ca->ca_net = $_POST['ca_net'];
            $this->ca->ca_value = $_POST['ca_value'];
            $this->ca->ca_cost = $_POST['ca_cost1'];
            $this->ca->ca_price = $_POST['ca_price1'];
            $this->ca->ca_datetime = date(DateTime::ATOM);
            if ($_POST['ca_net'] == 1) {
                $ca_value = CardModel::value_in_or_not($_POST['ca_net'], $_POST['ca_value']);
                if (!empty($ca_value)) {

                    $this->ca->ca_num = $_POST['ca_num1'] + $ca_value[0]['ca_num'];
                    if ($this->ca->updatecard($_POST['ca_net'], $_POST['ca_value']) >= 1) {
                        echo 'true';
                        die();
                    } else {
                        echo 'false';
                        die();
                    }
                } else {

                    $this->ca->ca_num = $_POST['ca_num1'];
                    if ($this->ca->insert() >= 1) {
                        echo 'true';
                        die();
                    } else {
                        echo 'false';
                        die();
                    }
                }
            } elseif ($_POST['ca_net'] == 2) {
                $ca_value = CardModel::value_in_or_not($_POST['ca_net'], $_POST['ca_value']);
                if (!empty($ca_value)) {

                    $this->ca->ca_num = $_POST['ca_num1'] + $ca_value[0]['ca_num'];

                    if ($this->ca->updatecard($_POST['ca_net'], $_POST['ca_value']) >= 1) {
                        echo 'true';
                        die();
                    } else {
                        echo 'false';
                        die();
                    }
                } else {

                    $this->ca->ca_num = $_POST['ca_num1'];

                    if ($this->ca->insert() >= 1) {
                        echo 'true';
                        die();
                    } else {
                        echo 'falsee';
                        die();
                    }
                }
            } elseif ($_POST['ca_net'] == 3) {
                $ca_value = CardModel::value_in_or_not($_POST['ca_net'], $_POST['ca_value']);
                if (!empty($ca_value)) {

                    $this->ca->ca_num = $_POST['ca_num1'] + $ca_value[0]['ca_num'];
                    if ($this->ca->updatecard($_POST['ca_net'], $_POST['ca_value']) >= 1) {
                        echo 'true';
                        die();
                    } else {
                        echo 'falseu';
                        die();
                    }
                } else {

                    $this->ca->ca_num = $_POST['ca_num1'];
                    if ($this->ca->insert() >= 1) {
                        echo 'true';
                        die();
                    } else {
                        echo 'falsee';
                        die();
                    }
                }
            }
        }
    }

}
