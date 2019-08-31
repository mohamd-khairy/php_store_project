<?php

class Charge {

    private $template;
    private $ch;
    private $sch;

    public function __construct() {
        $this->template = new Template();
        $this->ch = new ChargeModel();
        $this->sch = new SellchargeModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

      function checkchargeAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $currentCharge = ChargeModel::value_in_or_not ($_POST['sch_net']);
            if (!empty($currentCharge)) {
                $currentCharge = $currentCharge[0];
            }
            if ( $_POST['sch_value'] > $currentCharge['ch_charge']) {
                echo '   المبلغ المتاح   '.$currentCharge['ch_charge'];
                die();
            } else {
                echo 'true';
                die();
            }
        }
    }

    function convertAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $this->sch->sch_net = $_POST['sch_net'];
            $this->sch->sch_mobile = $_POST['sch_mobile'];
            $this->sch->sch_mony = $_POST['sch_mony'];
            $v = $this->sch->sch_value = $_POST['sch_value'];
            $this->sch->sch_datetime = date(DateTime::ATOM);
            if ($this->sch->insert() >= 1) {
                $chargeData = ChargeModel::value_in_or_not($_POST['sch_net']);
                if (!empty($chargeData)) {
                    $chargeData = $chargeData[0];
                }
                $this->ch->ch_datetime = $chargeData['ch_datetime'];
                $id = $this->ch->ch_id = $chargeData['ch_id'];
                $this->ch->ch_charge = $chargeData['ch_charge'] - $v;
                $this->ch->ch_mony = $chargeData['ch_mony'];
                $this->ch->ch_net = $chargeData['ch_net'];
                if ($this->ch->update($id)) {
                    echo 'true';
                    die();
                } else {
                    echo 'false';
                    die();
                }
            }
        }
        $this->template->render('charge/convert');
    }

    function showAction() {
        $this->template->render('charge/show');
    }

    function chargeAction() {
        $this->template->render('charge/charge');
    }

    function newAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $this->ch->ch_net = $_POST['ch_net'];
            $this->ch->ch_mony = $_POST['ch_mony1'] + $_POST['ch_mony2'];
            $this->ch->ch_charge = $_POST['ch_charge1'] + $_POST['ch_charge2'];
            $this->ch->ch_datetime = date(DateTime::ATOM);
            $ch_value = ChargeModel::value_in_or_not($_POST['ch_net']);
            if (!empty($ch_value)) {
                if ($this->ch->updatecharge($_POST['ch_net']) >= 1) {
                    echo 'true';
                    die();
                } else {
                    echo 'false';
                    die();
                }
            } else {
                if ($this->ch->insert() >= 1) {
                    echo 'true';
                    die();
                } else {
                    echo 'false';
                    die();
                }
            }
        }
    }

}
