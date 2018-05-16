<?php
 include 'conn.php';
 
 ?>
 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class='row col s12 m12 l12 xl12' style='background:#f7f7f7;'>
      <style>
		@media screen and (max-width: 2000px){
			#ds{
				display:block;
			}
			#hp{
				display:none;
			}
			#dstmn{
				display:block;
			}
		}
		@media screen and (max-width: 800px){
			#ds{
				display:none;
			}
			#hp{
				display:block;
			}
			#dstmn{
				display:none;
			}
		}
	  </style>
	  <!-- Modal Tambah Post -->
		<div id="update" class="modal">
			<div class="modal-content">
			  <h4>Update Data Analisis</h4>
			  <div id="proses" style="height:200px; overflow:scroll; overflow-x:hidden;">Tekan tombol proses untuk memulai</div>
			  <div class="row">
				<div class="col xl6 l6 m6 s6" style="text-align:right;"><a class="btn" onclick="pars()">Proses</a></div>
				<div class="col xl6 l6 m6 s6"><a class="btn" href="analitic.php">Refresh Page</a></div>
			  </div>
			</div>
			<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Batal</a></a>
		</div>
	  </div>
	  
	  
		
		<div id="grafik" class="col xl7 l7 m7 s12" style="padding:20px; background:white; box-shadow: 0px -2px 5px #888888; margin:100px 0px 0px 40px;">
			<canvas id="line-chart" ></canvas>
		</div>
		<div id="dstmn" class="col xl4 l4 m4 s12" style="margin:100px 0px 0px 30px;">
			<canvas id="canvas" style=" background:white;"></canvas>
			<div style="padding:30px; margin:20px 0px 0px 0px; background:white; text-align:center;">
				<p>Tekan tombol di bawah ini untuk mengupdate data</p>
				<a class='btn modal-trigger' href="#update">Update</a>
			</div>
		</div>
		
		<div id="hp" class="row" style="background:white; padding:20px; position:fixed; top:0px; width:100%;">
			<div class="col xl8 l8 m8 s12" style="font-family: 'Lobster', cursive; font-size:20px;">
				Social Station Analitics
			</div>
			
			<div class="col xl1 l1 m1 s3  material-icons" style="font-size:20px;">
				<a class=" material-icons" href="out.php">close</a>
			</div>
		</div>
		<div id="ds" class="row" style="background:white; padding:20px; position:fixed; top:0px; width:100%;">
			<div class="col xl8 l8 m8 s1 push-l1 push-xl1 push-m1" style="font-family: 'Lobster', cursive; font-size:20px;">
				Social Station Analitics
			</div>
			<div class="col xl2 l2 m1 s1 push-l1 push-xl1 push-m1 material-icons" style="font-size:20px;">
				<a class=" material-icons" href="chat.php">message</a>
			</div>
		</div>
		<!--Import jQuery before materialize.js-->      
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script src="js/Chart.bundle.js"></script>
	  <script src="js/utils.js"></script>
	  	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
		
		<?php
		$senang=array("selamat","semoga","indonesia","kerja","#BuruhTetapJokowi","saya","mengucapkan","seluruh","semakin","sejahtera","masa","depan","menghargai","SELAMAT","terima","kasih","kesejahteraan","majulah","amazing","Sedunia!","layak","ucapan","merayakan","momentum","bersyukur","membangun","terus","simple","memberikan","berjasa","harapan","quotes","cerdas","Amin","Amiin","teruslah","berkontribusi","gajian","akhirnya","kemenangan");
		$biasa=array("hari","buruh","pekerja","mei","kita","hak","orang","aku","mau","dari","lebih","pekerjaan","#HariBuruh","perjuangan","banyak","kawan","Sejarah","setiap","layak","keringatnya","Rakyat","2018","agar","membuat","Dunia","melakukan","kota","Presiden","negeri","bundaran","keringat","berjuang","rekan-rekan","readers","mencoba","dosenku","pengusaha","bekerja","ngucapin","mengubah");
		$kecewa=array("No","padahal","tidak","tak","keadlian","NOT","tapi","bukan","upahnya","apa","bill","cuma","terlalu","hard","upah","lagi","kepastian","jangan","Kasihan","aksi","protest","nasib","keluarganya","terabaikan","penting","kenapa","knp","perburuhan","memanas","perburuhan","kisah","pilu","demo","absen","#2019GantiPresiden","kenapa","sedih","lindungi","hak-haknya","gemakan");
		$sen=0;$bia=0;$kec=0;
		echo"
			<script>
				new Chart(document.getElementById('line-chart'), {
				  type: 'line',
				  data: {
					labels: [";
					//1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31
					$queri="SELECT* From analisi";   //menampikan SEMUA data dari tabel bel	
					$proses=mysqli_query ($con,$queri);
					$rows = mysqli_num_rows($proses);
					for($b=1;$b<=40;$b++){
						echo "$b,";
					}
					echo" ],
					datasets: [{ 
						data: [";
						for($c=0;$c<40;$c++){
							$queri="SELECT* From analisi where word='".$senang[$c]."'";   //menampikan SEMUA data dari tabel bel	
							$proses=mysqli_query ($con,$queri);
							$rows = mysqli_num_rows($proses);
							if($rows>0){
								while($data = mysqli_fetch_array($proses)){
									$sen+=$data['banyak'];
									echo "".$data['banyak'].", "; 
								}		
							}
							else{
								echo "0, "; 
							}
						}							
						echo"],
						label: 'Senang',
						borderColor: '#3e95cd',
						fill: true,
					  },
					  { 
						data: [";
						for($c=0;$c<40;$c++){
							$queri="SELECT* From analisi where word='".$biasa[$c]."'";   //menampikan SEMUA data dari tabel bel	
							$proses=mysqli_query ($con,$queri);
							$rows = mysqli_num_rows($proses);
							if($rows>0){
								while($data = mysqli_fetch_array($proses)){
									$bia+=$data['banyak'];
									echo "".$data['banyak'].", "; 
								}		
							}
							else{
								echo "0, "; 
							}
						}					
						echo"],
						label: 'Biasa',
						borderColor: '#f1f441',
						fill: true,
					  },
					  { 
						data: [";
						for($c=0;$c<40;$c++){
							$queri="SELECT* From analisi where word='".$kecewa[$c]."'";   //menampikan SEMUA data dari tabel bel	
							$proses=mysqli_query ($con,$queri);
							$rows = mysqli_num_rows($proses);
							if($rows>0){
								while($data = mysqli_fetch_array($proses)){
									$kec+=$data['banyak'];
									echo "".$data['banyak'].", "; 
								}		
							}
							else{
								echo "0, "; 
							}
						}						
						echo"],
						label: 'Kecewa',
						borderColor: '#f44141',
						fill: true,
					  },
					]
				  },
				  ";
				  $max=max($sen,$bia,$kec);
				  if($sen==$max)
					  $koo="Senang";
				  else if($bia==$max)
					  $koo="Biasa Saja";
				  else if($kec==$max)
					  $koo="Kecewa";
				  echo"options: {
					title: {
					  display: true,
					  text: 'Data Kondisi Netizen Saat Ini Sedang $koo'
					}
				  }
				});
			</script>
		";
		?>
		<script>
			$(document).ready(function(){
			// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
					$('.modal').modal();
				});
				
				$('#deljad').modal('close');
				$('.modal').modal({
					  dismissible: true, // Modal can be dismissed by clicking outside of the modal
					  opacity: .5, // Opacity of modal background
					  inDuration: 300, // Transition in duration
					  outDuration: 200, // Transition out duration
					  startingTop: '4%', // Starting top style attribute
					  endingTop: '10%', // Ending top style attribute
					  ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
						alert("Ready");
						console.log(modal, trigger);
					  },
					  complete: function() { alert('Closed'); } // Callback for Modal close
					}
				  );
			function pars(){
				$('#proses').load("proses.php");
			}
		</script>
		<!--grafik bar-->
		<?php
		$queri="SELECT* From analisi order by banyak DESC";   //menampikan SEMUA data dari tabel bel	
		$proses=mysqli_query ($con,$queri);
						
		echo"
		<script>
			var color = Chart.helpers.color;
			var horizontalBarChartData = {
				labels: [";
				$a=1;
				while($data = mysqli_fetch_array($proses)){
					echo "'".$data['word']."', "; 
					if($a>5)
						break;
					else
						$a++;
				}		
				echo"],
				datasets: [{
					label: 'Trending',
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
					borderColor: window.chartColors.red,
					borderWidth: 1,
					data: [";
					$queri="SELECT* From analisi order by banyak DESC";   //menampikan SEMUA data dari tabel bel	
					$proses=mysqli_query ($con,$queri);
						$a=1;
						while($data = mysqli_fetch_array($proses)){
							echo "".$data['banyak'].", "; 
							if($a>5)
								break;
							else
								$a++;
						}	
					echo"]
				}]

			};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myHorizontalBar = new Chart(ctx, {
				type: 'horizontalBar',
				data: horizontalBarChartData,
				options: {
					// Elements options apply to all of the options unless overridden in a dataset
					// In this case, we are setting the border of each horizontal bar to be 2px wide
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'right',
					},
					title: {
						display: true,
						text: 'Trending Topik'
					}
				}
			});

		};
		</script>
		";
		?>
    </body>
  </html>