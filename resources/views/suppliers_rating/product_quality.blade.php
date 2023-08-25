@for($i=1; $i<= 5; $i++)
<span style="font-size:18px" title="{{ $row['product_quality'] }}">{{ ($i <= $row['rating_product_quality']) ? "★" : "☆" }} </span>
@endfor