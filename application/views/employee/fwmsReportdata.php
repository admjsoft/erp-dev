<style>
.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
}
</style>
<?php

?>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('FWMS Report') ?></h5>
            <hr>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
			<div class="options">
         <a href="<?php echo site_url('fwms/fwmsreport')?>" class="btn btn-primary btn-block"><i class=""></i>Back                                                </a>
             </div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body" id="card-body">
			
			   <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
 <h4 style="text-align: center;"><u><?php echo $this->lang->line('FWMS Report') ?>
</u>
	 </h4>
     <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                 <tr>
                         <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
					 <th><?php echo $this->lang->line('Client') ?></th>
                        <th><?php echo $this->lang->line('Country') ?></th>
					     <th><?php echo $this->lang->line('Passport Number') ?></th>
					   <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					    <th><?php echo $this->lang->line('Permit') ?></th>
                        <th><?php echo $this->lang->line('Permit Expiry') ?></th>
						
                    </tr>
                </thead>
                <tbody>
				
				
                </tbody>

                <tfoot>
                   <tr>
                         <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
						  <th><?php echo $this->lang->line('Client') ?></th>
                        <th><?php echo $this->lang->line('Country') ?></th>
					     <th><?php echo $this->lang->line('Passport Number') ?></th>
					   <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					    <th><?php echo $this->lang->line('Permit') ?></th>
                        <th><?php echo $this->lang->line('Permit Expiry') ?></th>
						
                    </tr>
                </tfoot>
            </table>
    
            </div>
             
	   
	   
     </div>

          


		  </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
				
				
         </br>
                                  </form>
            </div>
        </div>
    </div>
</div>
    
 <script>
     function changeInputType(){
      document.getElementsByName("dateMonth")[0].value = null;
      document.getElementsByName("dateYear")[0].value = null;


      var val = document.getElementById("selectDateType").value;
      if (val == 0) {
        document.getElementById("inputMonth").style.display = "block";
        document.getElementById("inputYear").style.display = "none";

        document.getElementById("inputMonthForm").required = true;
        document.getElementById("inputYearForm").required = false;

      }else {
        document.getElementById("inputMonth").style.display = "none";
        document.getElementById("inputYear").style.display = "block";

        document.getElementById("inputMonthForm").required = false;
        document.getElementById("inputYearForm").required = true;

        var i = 10;
        var d = new Date();
        var year = d.getFullYear();

        for(i=1;i<=10;i++){
          document.getElementById("year"+i).value = year;
          document.getElementById("year"+i).innerHTML = year;
          year--;
        }
      }
    }
    </script>
   <script>
   
   $(document).ready(function() {
	// Function to convert an img URL to data URL
	function getBase64FromImageUrl(url) {
    var img = new Image();
		img.crossOrigin = "anonymous";
    img.onload = function () {
        var canvas = document.createElement("canvas");
        canvas.width =this.width;
        canvas.height =this.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(this, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    };
    img.src = url;
	}
	// DataTable initialisation
	$('#trans_table').DataTable(
		{
			 fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('employee/fwmsReportGenerateAjax')?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash,company:<?php  if(!empty($company)){ echo $company=$company;}else{ echo"0"; };?>,employee:<?php  if(!empty($employee)){ echo $employee=$employee;}else{ echo"0"; };?>}
            },
    
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
				{
					text: 'PDF',
					extend: 'pdfHtml5',
					filename: 'fwms_pdf',
					orientation: 'landscape', //portrait
					pageSize: 'A4', //A3 , A5 , A6 , legal , letter
					exportOptions: {
						columns: ':visible',
						search: 'applied',
						order: 'applied'
					},
					customize: function (doc) {
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
						var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
						// Logo converted to base64
						// var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
						// The above call should work, but not when called from codepen.io
						// So we use a online converter and paste the string in.
						// Done on http://codebeautify.org/image-to-base64-converter
						// It's a LONG string scroll down to see the rest of the code !!!
						//conert image into base64 then add here for every comany here is a logo for sbcounsltant //
                   var logo='data:image/png;base64,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'						// https://github.com/bpampuch/pdfmake#getting-started
						// Set page margins [left,top,right,bottom] or [horizontal,vertical]
						// or one number for equal spread
						// It's important to create enough space at the top for a header !!!
						doc.pageMargins = [20,60,20,30];
						// Set the font size fot the entire document
						doc.defaultStyle.fontSize = 7;
						// Set the fontsize for the table header
						doc.styles.tableHeader.fontSize = 7;
						// Create a header object with 3 columns
						// Left side: Logo
						// Middle: brandname
						// Right side: A document title
						doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 24
									},
									{
										alignment: 'left',
										italics: true,
										text: 'JsuitesCloud',
										fontSize: 18,
										margin: [10,0]
									},
									{
										alignment: 'right',
										fontSize: 14,
										text: ''
									}
								],
								margin: 20
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Created on: ', { text: jsDate.toString() }]
									},
									{
										alignment: 'right',
										text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
									}
								],
								margin: 20
							}
						});
						// Change dataTable layout (Table styling)
						// To use predefined layouts uncomment the line below and comment the custom lines below
						// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
						var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
				}
				}]
		});
});
   
   
   
  $(document).ready(function () {
	  
        



    });
    </script>