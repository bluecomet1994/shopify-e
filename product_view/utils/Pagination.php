<?php

class Pagination 
{
    public $pIndex;
    public $resultsperpage;
    public $getnumber;
    public $stopnumber;
    public $realreceivednumber;

    public function getNumber($n)
    {
        $this->getnumber = $n;
        return $this->getnumber;
    }

    public function decidesPages($rn)
    {
        $receivednumber = $rn;
        $this->resultsperpage = 4;
        $this->stopnumber = ceil($this->getnumber / $this->resultsperpage);
        
        if ($receivednumber <= 0) {
            $receivednumber = 0;
            $pagenumber = ($receivednumber) * 4;
        } else if ($receivednumber >=  $this->stopnumber) {
            //$pagenumber = (( $this->stopnumber-1 ) * 1);
            $st= $this->stopnumber;
            //$pagenumber = ($st-1)*4;
            $receivednumber =  $this->stopnumber - 1;
             $pagenumber =$this->stopnumber;
        } else {
            
            $pagenumber = ($receivednumber) * 4;
        }
        $this->realreceivednumber = $receivednumber;
        return $pagenumber;
    }

   
    public function returnRealReceiveNumber(){
        return $this -> realreceivednumber ;
    }

    public function returnStopNumber(){
        return  $this->stopnumber;
    }
}
?>