@verbatim

{% if template contains 'product' %}
  <div class="product-analytics popup-top-bar">
    <div class="analytics-message"><b id="product_shopper_count">0</b> shoppers currently viewing this product.</div>  
</div>
{% endif %}
{% unless template contains 'product' %}
<div class="site-analytics popup-top-bar">
    <div class="analytics-message"><b id="site_shopper_count">0</b> shoppers currently viewing this website.</div>  
</div>
{% endunless %}

<style>
  .popup-top-bar{
    width:100%;
    float:left;
    position:fixed;
    top:0;
    left:0;
    background:#000;
    color:#fff;
    z-index: 9999;
  }
  .popup-top-bar .analytics-message{
    width:100%;
    float:left;
    text-align:center;
    font-size:18px;
  }
</style>

@endverbatim