                       

</tr>
</table>
</div>
</div>
<style>
    #menubar
    {
        width: 920px;
        height: 50px;
        text-align: center; 
        background: transparent url('<?= HostName ?>./images/menu.jpg' ) repeat; 
        border-radius: 15px 15px 15px 15px;
        -moz-border-radius: 15px 15px 15px 15px;
        -webkit-border: 15px 15px 15px 15px;
        -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px;
        -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px;
        box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px;
    }
    ul#menu
    { margin:0;
    }

    ul#menu li
    { 

        padding: 0 0 0 0px;
        list-style: none;
        margin: 2px 0 0 0;
        display: inline;
        background: transparent;}

    ul#menu li a
    {


        float: left;
        font: bold 120% Arial, Helvetica, sans-serif;
        margin: 0 0 0 50px;
        text-shadow: 0px -1px 0px #000;
        padding: 6px 20px 0 20px;
        background: transparent; 
        border-radius: 7px 7px 7px 7px;
        -moz-border-radius: 7px 7px 7px 7px;
        -webkit-border: 7px 7px 7px 7px;
        text-align: center;
        color: #FFF;
        text-decoration: none;} 

    ul#menu li.current a
    { color: #1D1D1D;
      background: #FFF;
      background: -moz-linear-gradient(#fff, #ccc);
      background: -o-linear-gradient(#fff, #ccc);
      background: -webkit-linear-gradient(#fff, #ccc);
      text-shadow: none;}

    ul#menu li:hover a
    { color: #1D1D1D;
      background: #FFF;
      background: -moz-linear-gradient(#fff, #ccc);
      background: -o-linear-gradient(#fff, #ccc);
      background: -webkit-linear-gradient(#fff, #ccc);
      text-shadow: none;}


</style>
</body>

</html>
<script>
    ChangeUrl('page1', 'index.php');
</script>
