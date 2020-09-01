<?php
include_once APPPATH . '/third_party/fpdf181/pdf.php';

class Pdf_mcTable extends FPDF
{
    var $widths;
    var $aligns;

    function Header(){   
        // Header Page
        $img = base_url('assets/images/logobmg.png');   
        $alamat = "Komp. Sentosa Purnama Jaya Blok B No. 9 - 11";
        $alamat2 = "Batu Ampar - Batam." ;
        global $title ;
        $lebar = $this->w;
        $this->SetFont('Arial','B',12);
        $w = $this->GetStringWidth($title );

        $this->Image($img,30,10,25);
    // setting jenis font yang akan digunakan
        // $this->SetFont('Arial','',10);
        $this->Cell(190,7,'Bias Mandiri Group',0,1,'R');
        $this->Cell(190,7,$alamat,0,1,'R');
        $this->Cell(190,7,$alamat2,0,1,'R');
        $this->Ln();
        $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
        $this->Ln(5);
    //     global $title ;
    //     $lebar = $this->w;
    //     $this->SetFont('Arial','B',15);
    //     $w = $this->GetStringWidth($title );
    //     $this->SetX(($lebar -$w)/2);
    //     $this->Cell($w,9,$title  ,0,0,'C');
    //     $this->Ln();
    //     $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
    //     $this->Ln(10);
    }                

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function Footer() {               
        $this->SetY(-15);   
        $lebar = $this->w;   
        $this->SetFont('Arial','I',8);           
        $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
        $this->SetY(-15);
        $this->SetX(0);       
        $this->Ln(1);
        $hal = 'Page : '.$this->PageNo().'/{nb}' ;
        $this->Cell($this->GetStringWidth($hal ),10,$hal );   
        $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
        $tanggal  = 'Printed : '.date('d-m-Y  h:i-a').' ';
        $this->Cell($lebar-$this->GetStringWidth($hal )-$this->GetStringWidth($tanggal)-20);   
        $this->Cell($this->GetStringWidth($tanggal),10,$tanggal );   
    
}   
}
?>