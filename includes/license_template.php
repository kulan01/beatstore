
<?php
include 'db.php';
session_start();

if (isset($_POST['id'])){
 $id = mysqli_real_escape_string($connection, $_POST['id']);
}
else {
  echo 'none selected';
  die();
}
if(isset($_POST['transaction'])){
  $transaction = mysqli_real_escape_string($connection, $_POST['transaction']);

  $query = "SELECT * FROM transaction WHERE paymentId  = '$transaction'";
  $result = mysqli_query($connection, $query);
  if(mysqli_num_rows($result) == 0){
    header("Location: index.php");
    die('no results');
  }
  foreach($result as $row){
    $buyer_id = $row['buyer_id'];

    
    $buyer_query = "SELECT * FROM users WHERE id  = '$buyer_id'";
    $buyer_result = mysqli_query($connection, $buyer_query);
    if(mysqli_num_rows($buyer_result) == 0){
      header("Location: index.php");
      die('no results');
    }
    foreach($buyer_result as $buyer_row){
      $buyer_name = $buyer_row['name'];
    $buyer_stage_name = $buyer_row['stage_name'];
    }
    
  }
}
else {
  $buyer_name = (isset($_SESSION['name']) ? $_SESSION['name'] : "John Doe");
  $buyer_stage_name = (isset($_SESSION['stage_name']) ? $_SESSION['stage_name'] : "John Doe");
}

$producer_name = "Issa Famous";
$beat_name = (isset($_POST['beat_name']) ? $_POST['beat_name'] : "DEMO BEAT");

$response = [];

$query = "SELECT * FROM licenses WHERE id = {$id}";
$result = mysqli_query($connection, $query);
if(!$result){
  die('error');
}
foreach($result as $row){
  $sales = $row['num_sales'];
  $license_name = $row['license_name'];
  $price = floatval($row['price']);
  $downloads = $row['num_downloads'];
  $streams = $row['num_streams'];
  $isProfitable = $row['isProfitable'];
  $performances = $row['num_performances'];
  $num_videos = $row['num_videos'];
  $num_mon_video = $row['num_mon_videos'];
  $num_radio = $row['radio_stations'];
  $years_active = $row['years_active'];


  $response['type'] = $license_name;
}


$zone = new DateTimeZone('America/New_York');

date_default_timezone_set('America/New_York');
$date = new DateTime();


//$date = date_create_from_format('Y-m-d H:i:s','now', $zone);

$time =  $date->format(' D,  M d Y H:i:s P');

//this is the actual string that is either displayed or outputed to a txt file

 $license_temp = "<p><p><strong>THIS LICENSE AGREEMENT</strong> is made on {$time} (\"Effective Date\") by and between {$buyer_name} (hereinafter referred to as the \"Licensee\") also, if applicable, professionally known as (". ($buyer_stage_name === '' ? $buyer_name : $buyer_stage_name) . "), and {$producer_name} (\"Songwriter\"). (hereinafter referred to as the \"Licensor\"). Licensor warrants that it controls the mechanical rights in and to the copyrighted musical work entitled {$beat_name} (\"Composition\") as of and prior to the date first written above. The Composition, including the music thereof, was composed by {$producer_name} (\"Songwriter\") managed under the Licensor.</p>

<p><strong>All licenses are non-refundable and non-transferable.</strong></p>

<p><strong>Master Use.</strong> The Licensor hereby grants to Licensee a non-exclusive license (this  License) to record vocal synchronization to the Composition partly or in its entirety and substantially in its original form (\"Master Recording\")</p>

<p><strong>Mechanical Rights.</strong> The Licensor hereby grants to Licensee a non-exclusive license to use Master Recording in the reproduction, duplication, manufacture, and distribution of phonograph records, cassette tapes, compact disk, digital downloads, other miscellaneous audio and digital recordings, and any lifts and versions thereof (collectively, the \"Recordings\", and individually, a \"Recordings\") worldwide for up to the pressing or selling a total of {$sales} copies of such Recordings or any combination of such Recordings, condition upon the payment to the Licensor a sum of $$price, receipt of which is confirmed. Additionally licensor shall be permitted to distribute {$downloads} internet downloads or streams for profit and commercial use. This license allows up to {$streams} monetized audio streams. This license is ". ($isProfitable ? 'also': 'not' ). " eligible for monetization on YouTube.</p>

<p><strong>Performance Rights.</strong> The Licensor here by grants to Licensee a non-exclusive license to use the Master Recording in {$performances} profitable performances, shows, or concerts. Licensee may " . ($isProfitable ? '': 'not' ) . " receive compensation from performances with this license.</p>

<p>Synchronization Rights. The Licensor hereby grants limited synchronization rights for {$num_videos} music video streamed online (Youtube, Vimeo, etc..) for up to {$num_mon_video} monetized video streams on all total sites. A separate synchronization license will need to be purchased for distribution of video to Television, Film or Video game.</p>

<p><strong>Broadcast Rights.</strong> The Licensor hereby grants to Licensee broadcasting rights up to {$num_radio} Radio Stations.</p>

<p><strong>Credit.</strong> Licensee shall acknowledge the original authorship of the Composition appropriately and reasonably in all media and performance formats under the name {$producer_name} in writing where possible and vocally otherwise.</p>

<p><strong>Consideration.</strong> In consideration for the rights granted under this agreement, Licensee shall pay to licensor the sum of $$price US dollars and other good and valuable consideration, payable to \"{$producer_name}\", receipt of which is hereby acknowledged. If the Licensee fails to account to the Licensor, timely complete the payments provided for hereunder, or perform its other obligations hereunder, including having insufficient bank balance, the licensor shall have the right to terminate License upon written notice to the Licensee. Such termination shall render the recording, manufacture and/or distribution of Recordings for which monies have not been paid subject to and actionable infringements under applicable law, including, without limitation, the United States Copyright Act, as amended.</p>

<p><strong>Indemnification.</strong> Accordingly, Licensee agrees to indemnify and hold Licensor harmless from and against any and all claims, losses, damages, costs, expenses, including, without limitation, reasonable attorney's fees, arising of or resulting from a claimed breach of any of Licensee's representations, warranties or agreements hereunder.</p>

<p><strong>Audio Samples.</strong> 3rd party sample clearance is the responsibility of the licensee.</p>

<p><strong>Miscellaneous.</strong>  This license is non-transferable and is limited to the Composition specified above, constitutes the entire agreement between the Licensor and the Licensee relating to the Composition, and shall be binding upon both the Licensor and the Licensee and their respective successors, assigns, and legal representatives.</p>

<p><strong>Governing Law.</strong> This License is governed by and shall be construed under the law of the California, United States, without regard to the conflicts of laws principles thereof.</p>

<p><strong>Terms.</strong> Executed by the Licensor and the Licensee, to be effective as for all purposes as of the Effective Date first mentioned above and shall terminate exactly {$years_active} years from this date.</p>

<p><strong>Publishing.</strong> Licensor grants Licensee 0% of publishing rights. Licensor maintains all publishing rights.</p>
";

if(isset($_POST['transaction'])){
  echo $license_temp;
  
}
else{
    $response['content'] = $license_temp;
    echo json_encode($response);
}