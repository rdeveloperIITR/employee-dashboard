var xhttp;
if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xhttp=new XMLHttpRequest();
}   else{ // code for IE6, IE5
    xhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    	getResponse(JSON.parse(xhttp.responseText));
    }
};
xhttp.open("GET", "getrecords.php", true);
xhttp.send();

 
function getResponse(response){
         var resultJson= response; 
         
         //create a table 
         var records =document.getElementById("records"); 
         var tbl = document.createElement('table');
             tbl.setAttribute('border', '1');
             tbl.setAttribute('width', '100%');
             tbl.id="recordTable";
         var tbdy = document.createElement('tbody');
         var headers=['Id','Employee Name','Designation','Salary','Delete'];
         if(resultJson.length!=0){
         	  document.getElementById("noRecords").style.display="none";
         }else{
         	  document.getElementById("noRecords").style.display="block";
         }

         for(var row=0;row<=resultJson.length;row++){
         	   var tr = document.createElement('tr');
               
               if(row == 0){
                   tr.id="headers";
                   for(var col=0;col<headers.length;col++){
    		            var th = document.createElement('th');
                        th.appendChild(document.createTextNode(headers[col]));
                        tr.appendChild(th);
                    } 

               }else{

                    var employeeId=resultJson[row-1]["id"];
                    tr.id=employeeId;

                    var td1=document.createElement('td');
                    td1.appendChild(document.createTextNode(resultJson[row-1]["id"]));
                    tr.appendChild(td1);
                    
                    var td2=document.createElement('td');
                    td2.appendChild(document.createTextNode(resultJson[row-1]["EmployeeName"]));
                    tr.appendChild(td2);

                    var td3=document.createElement('td');
                    td3.appendChild(document.createTextNode(resultJson[row-1]["Designation"]));
                    tr.appendChild(td3);

                    var td4=document.createElement('td');
                    td4.appendChild(document.createTextNode(resultJson[row-1]["Salary"]));
                    tr.appendChild(td4);


                    var td5=document.createElement('td');
                    //create delete button 
                    var btn = document.createElement('input');
                    btn.type = "button";
                    btn.value = "Delete";
                    btn.onclick =(function(employeeId) { 
                            return function() {
                                 console.log(employeeId);
                                 deleteRecord(employeeId);
                            }
                    })(employeeId);
                    td5.appendChild(btn);
                    tr.appendChild(td5);

               }
         	   tbdy.appendChild(tr); 
         }
         if(resultJson.length!=0){
              tbl.appendChild(tbdy);
              records.appendChild(tbl);
         }
        indexDataImport();
   }

function deleteRecord(employeeId){
        xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                     var msg=this.responseText;
                     if(msg=="success"){
                         var row=document.getElementById(employeeId);  //delete corresponding row
                         row.parentNode.removeChild(row);  
                     }

                     if(document.getElementById("recordTable").rows.length==1){
                          document.getElementById("headers").parentNode.removeChild(document.getElementById("headers"));
                          document.getElementById("noRecords").style.display="block";
                      }
                    indexDataImport();					  
                }
        };
        xhttp.open("GET","deleterecord.php?q="+employeeId, true);
        xhttp.send();
}

function getFilterRecords(searchQuery){
	   if(searchQuery==""){
		   updateDataTable(searchQuery);
	   }else{
	        xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                	 if(document.getElementById("recordTable")!=null) {
						  document.getElementById("records").removeChild(document.getElementById("recordTable"));
			         } 
                     var json= JSON.parse(this.responseText);
                     var data=json['response']['docs']; //array of results
                     getResponse(data); 
                }
            };
            xhttp.open("GET","http://localhost:8983/solr/collection1/select?wt=json&indent=true&q=collector:"+searchQuery, true);
            xhttp.send(); 
	   }		
 }

 function updateDataTable(value){
 	 if(value==""){
		 console.log("updated");
		 xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
			        if(document.getElementById("recordTable")!=null) {
						  document.getElementById("records").removeChild(document.getElementById("recordTable"));
			        } 
    	            getResponse(JSON.parse(xhttp.responseText));
            }
         };
         xhttp.open("GET", "getrecords.php", true);
         xhttp.send();
	 }
 }
 
 function indexDataImport(){
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				  console.log(this.responseText);
			 }
		};
		xhttp.open("GET","http://localhost:8983/solr/dataimport?command=full-import&wt=json&indent=true", true);
		xhttp.send(); 
 }
 
 