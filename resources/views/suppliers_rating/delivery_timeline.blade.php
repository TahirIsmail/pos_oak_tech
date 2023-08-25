@for($i=1; $i<= 5; $i++)
<span style="font-size:18px" title="{{ $row['delivery_timeline'] }}">{{ ($i <= $row['rating_delivery_timeline']) ? "★" : "☆" }} </span>
@endfor