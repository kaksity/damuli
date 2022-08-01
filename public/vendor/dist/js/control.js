  document.getElementById('home-tab').addEventListener('click', loadState);
    document.getElementById('home-tab').addEventListener('click', loadActive);
    document.getElementById('referesh').addEventListener('click', loadActive);
    document.getElementById('referesh').addEventListener('click', loadState);
  

    function PrintTable() {
        var printWindow = window.open("", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=300,width=800px,height=800px");
        printWindow.document.write('<html><head><title>Print Attendance List</title>');
 
        //Print the Table CSS.
        var table_style = "body{font-family: Arial;font-size: 10pt;}table{width:100%; border: 1px solid #ccc;border-collapse: collapse;}table th{background-color: #F7F7F7;color: #333;font-weight: bold;}table th, table td{padding: 5px;border: 1px solid #ccc;}";
        printWindow.document.write('<style type = "text/css">');
        printWindow.document.write(table_style);
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById("dvContents").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    }
            function loadState() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../views/process.php', true);

                xhr.onload = function () {
                    if (this.status == 200) {
                        //console.log(this.responseText);
                        var getState = JSON.parse(this.responseText);
                        var st = '';
                        for (var i in getState) {
                    st +=  '<tr>'+
                            '<th scope="row">'+ getState[i].id +'</th>'+
                            '<td>'+ getState[i].name +'</td>'+
                            '<td>'+ getState[i].email +'</td>'+
                            '<td>'+ getState[i].phone +'</td>'+  
                            '<td>'+ getState[i].timeAtt +'</td>'+
                            '<td>'+ getState[i].numOfMov +'</td>';
                            
                            
                         if(getState[i].status == 0){
                          st += '<td class="bg-danger">Not Active</td>'+
                          '</tr>';
                         }else{
                          st += '<td class="bg-success">Active</td>'+
                          '</tr>';
                         } 
                        }
                        document.getElementById('tab-content').innerHTML = st;
                    }
                }
                xhr.send();
            }
            function loadActive() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../views/fetch_active.php', true);

                xhr.onload = function () {
                    if (this.status == 200) {
                        
                        var active = JSON.parse(this.responseText);
                        
                        var s = '';
                        
                        document.getElementById('active-badge').innerHTML = active.active;
                        document.getElementById('inactive-badge').innerHTML = active.deactive;
                       
                    }
                }
                xhr.send();
            }

    
            
           
