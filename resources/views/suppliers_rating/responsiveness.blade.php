@for($i=1; $i<= 5; $i++)
<span style="font-size:18px" title="{{ $row['responsiveness'] }}">{{ ($i <= $row['rating_responsiveness']) ? "★" : "☆" }} </span>
@endfor