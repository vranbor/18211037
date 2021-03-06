<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FM SuperSoccer Helper</title>
        <link rel="stylesheet" href="style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>

        <div class="center">
            <h1>FM SuperSoccer Helper</h1>
            <h5>by Prama Aditya (18211037) and Mekaputra Yudahandika (18211057)</h5>
           <br/>
            <div id="playerkarusel" class="center"></div>
        
            <script id="playertpl" type="text/template">
                <div class="flat-table" >
                        <table class="center">
                            <tr>
                                <th>Nama</th>
                                <th >Posisi</th>
                                <th>Gaji</th>
                                <th>Nilai</th>
                            </tr>
                            {{#players}}
                                <tr>
                                    <td>{{Nama}}</td>
                                    <td>{{Posisi}}</td>
                                    <td class="harga"><label>ss$</label> {{Gaji}}</td>
                                    <td class="harga"><label>ss$</label> {{Nilai}}</td>
                                </tr>
                            {{/players}}
                        </table>
                </div>
            </script>
           <br /> 
            <form name ="myform" id="myform"> 
                <select name="mydropdown" id="database">
                <option value="Liverpool">Liverpool Player</option>
                <option value="Other">Other</option>
                <option value="Shortlist">Shortlisted</option>
                </select> <br/>
                <INPUT type="checkbox" name="all" id="all" onclick ="toggleform('document.myform','all','playerid')"checked> All 
                    <label> or Input ID:</label>
                <input type="text" name="playerid"id="playerid" disabled="true"> <br />
                <input type="button" value="Search" onClick="doStuff()"> <br />
            </form> 
            
        </div>
        <script src="jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="mustache.js"></script>  
        <script>
            function enableob(o) { eval(o+".disabled = false"); }
            function disableob(o) { eval(o+".disabled = true"); }
            function toggleform(formstr,chkobstr,obstr) {
            var checked = eval(formstr+"."+chkobstr+".checked");
            var obs = obstr.split(",");
              for (i = 0; i < obs.length; i++) {
              obs[i] = formstr+"."+obs[i];
              }
              if (checked == true) {
                for (i = 0; i < obs.length; i++) {
                disableob(obs[i]);
                }
              }
              else {
                for (i = 0; i < obs.length; i++) {
                enableob(obs[i]);
                }
              }
            }
            function doStuff(){
            var banyak = document.getElementById("all").checked;
            var playerid = document.getElementById("playerid").value;
            var database =  document.getElementById("database").value;
            if (banyak==false)
            var getJSONurl = 'http://localhost:8888/progin/RestWebService/index.php/api/'+database+'/player/id/'+playerid+'/format/json.json';
            else
            var getJSONurl = 'http://localhost:8888/progin/RestWebService/index.php/api/'+database+'/players/format/json.json';
            $.getJSON(getJSONurl, function (data){
                var template = $('#playertpl').html();
                var html = Mustache.to_html(template,data);
                $('#playerkarusel').html(html);
            });
            }
        </script>
        

    </body>
</html>