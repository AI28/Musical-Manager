<?php
function fetch_data()
{
    $output = '';
    $conn = mysqli_connect("localhost", "root", "parola12", "tw");
    $sql = "SELECT * FROM songs ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<tr>  
                          <td>' . $row["id"] . '</td>  
                          <td>' . $row["album_id"] . '</td>  
                          <td>' . $row["artist_id"] . '</td>  
                          <td>' . $row["song_title"] . '</td>  
                          <td>' . $row["number_of_likes"] . '</td> 
                          <td>' . $row["uploaded_at"] . '</td> 
                     </tr>  
                          ';
    }
    return $output;
}
if (isset($_POST["generate_pdf"])) {
    require_once('tcpdf-master/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 11);
    $obj_pdf->AddPage();
    $content = '';
    $content .= '  
      <h4 align="center">Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%">Id</th>  
                <th width="20%">Artist_id</th>  
                <th width="15%">Album_id</th>  
                <th width="20%">Song_title</th>  
                <th width="20%">Number_of_likes</th> 
                <th width="20%">Uploaded_at</th> 
           </tr>  
      ';
    $content .= fetch_data();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('file.pdf', 'I');
}
?>
