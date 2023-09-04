Report brand <i> {{ $brand->name }} </i>,
<br>
Top brand's products:
@foreach($products as $product)
    <p> ---------------------------------------- </p>
    <p> Name: <b>{{ $product->name }}</b> </p>
    <p> Price: {{ floatval($product->item_price) }} </p>
@endforeach
