
<style>
    input,th{
        text-align: center;
    }
</style>
<div id="show" style="margin-top: 3%">
    <center>
        <button class="btn btn-success"  onclick="mido('?rt=Card/add')">إضافه كرووت</button>
    </center><br>
    <table border="1"  class="table">
        <tr>
            <th style="background-color: #00cc00">Etisalat</th>
            <th style="background-color: #ff9900">Mobinil</th>
            <th style="background-color: #ff0000">Vodafone</th>
            <th style="width: 25%; background-color: #cccccc" >قيمه الكارت </th>

        </tr>

        <?php
        $cards = CardModel::getAllData();
        foreach ($cards as $ca) {
            $c[] = $ca['ca_value'];
        }
        $result = array_unique($c);
        ?>
        <tr>
            <?php
            $sum3 = 0;
            $sum2 = 0;
            $sum = 0;
            foreach ($result as $ca) {
                $data3 = CardModel::value_in_or_not(3, $ca);
                if (!empty($data3)) {
                    foreach ($data3 as $d) {
                        $sum3+= $d['ca_cost'];
                    }
                    ?>
                    <td style="text-align: center"><?= $data3[0]['ca_num'] ?></td>
                <?php } else { ?>                <td style="text-align: center">0</td>
                    <?php
                }
                $data2 = CardModel::value_in_or_not(2, $ca);
                if (!empty($data2)) {
                    foreach ($data2 as $d) {
                        $sum2+= $d['ca_cost'];
                    }
                    ?>
                    <td style="text-align: center"><?= $data2[0]['ca_num'] ?></td>
                <?php } else { ?>                <td style="text-align: center">0</td>
                    <?php
                }
                $data1 = CardModel::value_in_or_not(1, $ca);
                if (!empty($data1)) {
                    foreach ($data1 as $d) {
                        $sum+= $d['ca_cost'];
                    }
                    ?>
                    <td style="text-align: center"><?= $data1[0]['ca_num'] ?></td>
                <?php } else { ?>                <td style="text-align: center">0</td>
                <?php } ?>
                <td style="text-align: right ;color: #122b40;font-weight: bold"><span class="pull-left"> <div style="color: #122b40;font-weight: bold">عدد  الكروت</div></span> <?= $ca ?></td>
            </tr>
            <?php
        }
        ?>
    



    </table>
</div>
