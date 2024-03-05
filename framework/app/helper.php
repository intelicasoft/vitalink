<?php
function date_change($date){
  if($date!=null){
    $carbonDate = \Carbon\Carbon::parse($date);
    if(env('date_settings')!='' || env('date_settings')!= null)
    {
    $formattedDate = $carbonDate->format(env('date_convert'));
    }
    else{
        $formattedDate=$date;
    }
    return $formattedDate;
} 

else{
      return $date;
}
}
?>