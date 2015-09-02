<?php
 class rss {
     var $feed;

  function rss($feed) 
    {   $this->feed = $feed;  }
 
  function parse() 
    {
    $rss = simplexml_load_file($this->feed);
    
    $rss_split = array();
    foreach ($rss->channel->item as $item) {
    $title = (string) $item->title; // Title
    $link   = (string) $item->link; // Url Link
    $description = (string) $item->description; //Description
    $pub_date = (string) $item->pubDate; // pub date
    $rss_split[] = '<li class="collection-item avatar">
    <i class="material-icons circle green">H</i>
    <span class="title"><a href="'.$link.'" target="_blank" title="" >'.$title.' </a></span><p>'.$description.'</p><p><strong>'.$pub_date.'</strong></p>
    </li>';
    }
    return $rss_split;
  }

  function get_display($numrows,$head) 
  {
    $rss_split = $this->parse();
    $i = 0;
    $rss_data = '<div class="container">
           <div class="heading">
         '.$head.'
           </div>
         <div><ul class="collection">';
    while ( $i < $numrows ) 
   {
      $rss_data .= $rss_split[$i];
      $i++;
    }
    $trim = str_replace('', '',$this->feed);
    $user = str_replace('&lang=en-us&format=rss_200','',$trim);
    $rss_data.='</ul></div></div>';
    return $rss_data;
  }
}
?>