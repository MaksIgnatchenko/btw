<ul class="product__list {{ProductsViewHelper::checkTemplate(ProductsViewTemplateEnum::LIST) ? 'product__list--horizontal' : ''}}">
    @foreach($products as $product)
        @include('products.web.product', ['product' => $product])
    @endforeach
</ul><!-- /. end product list -->
<script type="text/javascript">
    $(function(){
        $('a[data-name="change-product-status"]').click(function(e){
            e.preventDefault();
            var token = "{{csrf_token()}}";
            $.ajax($(this).attr('href'), {
                method: 'POST',
                data: {
                    _method: 'PUT',
                    _token: token
                },
                success: function(response) {
                    if(response.error){
                        alert(response.error)
                    } else {
                        location.reload();
                    }
                }
            });
        })
    });
</script>
