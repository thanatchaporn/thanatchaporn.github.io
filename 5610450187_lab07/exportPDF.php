<?php
function fetch_data(){
    $output='';
    $connect=mysqli_connect("localhost","root","45018140","dreamhome");
    $query="SELECT DISTINCT Client.clientno, Client.fname, Client.lname, Viewing.viewdate,PropertyForRent.city
            FROM Client
            INNER JOIN Viewing ON Client.clientno=Viewing.clientno
            INNER JOIN PropertyForRent ON Viewing.propertyno=PropertyForRent.propertyno";
    $result = mysqli_query($connect,$query);
    while($row = mysqli_fetch_array($result)){
        $output.='          
        <tr>
            <td>'.$row["clientno"].'</td>
            <td>'.$row["fname"].'</td>
            <td>'.$row["lname"].'</td>
            <td>'.$row["viewdate"].'</td>
            <td>'.$row["city"].'</td>
        </tr>
        ';

    }
    return $output;

}

    require_once("tcpdf/tcpdf.php");
    $obj_pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Export HTML Table data using TCPDF in PHP");
    $obj_pdf->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
    $obj_pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
    $obj_pdf->SetPrintHeader(false);
    $obj_pdf->SetPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE,10);
    $obj_pdf->SetFont('helvetica','',12);
    $obj_pdf->AddPage('P','A4');

    $content='';

    $content .='
                 <h3 align="center">Export HTML Table data using TCPDF in PHP</h3>
                 <table border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th width="15%">ClientNo</th>
                        <th width="27%">Firstname</th>
                        <th width="27%">LastNname</th>
                        <th width="15%">Viewdate</th>
                        <th width="15%">City</th>
                    </tr>
                    <tbody>
    ';

    $content .= fetch_data();

    $content .='</table>';

    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('dreamhome.pdf','I');

?>
