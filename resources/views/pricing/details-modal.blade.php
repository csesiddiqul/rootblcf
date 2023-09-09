{{-- Modal for Details --}}
<div class="modal fade" id="myPriceDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" id="priceDetails">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body p-0"> 
                <div class="panel price panel-grey">
                    <div class="panel-heading arrow_box text-center">
                    <h3 class="plan-title"></h3>
                    </div>
                    <div class="panel-body text-center">
                        <div class="lead">
                            <strong class="modal-price"></strong>
                            <h3 class="modal-month"></h3>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item modal-details"></li>  
                    </ul> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal">Close</button>
                {{--<button type="button" class="btn btn-primary">Save</button>--}}
            </div>
        </div>
    </div>
</div> 

@push('script')
    <script> 
        $('#myPriceDetails').on('show.bs.modal', function (e) { 
            var opener=e.relatedTarget;

            var typeename = $(opener).attr('type-name');
            var titlename = $(opener).attr('title-name');
            var modal_price = $(opener).attr('price-name');
            var modal_month = $(opener).attr('month-name');
            var modal_details =$(opener).attr('detail-name'); 
            if (modal_month==0) {
                $('#priceDetails').find('.modal-month').text(modal_month).hide();
                $('#priceDetails').find('.modal-price').removeClass("forsubMonth");
            }else{
                $('#priceDetails').find('.modal-price').addClass("forsubMonth");
                if (typeename=='Installation') {
                    $('#priceDetails').find('.modal-month').text('With '+modal_month+' Subscription').show();
                }else{
                    $('#priceDetails').find('.modal-month').text(modal_month).show(); 
                };
                
            }; 
            
            $('#priceDetails').find('.modal-title').text(typeename);
            $('#priceDetails').find('.plan-title').text(titlename);
            $('#priceDetails').find('.modal-price').text(modal_price);
            $('#priceDetails').find('.modal-details').html(modal_details);
           
        });
    </script>
@endpush 
<style type="text/css"> 
    .modal-month {
        margin: 0px;
        font-size: 18px;
    }
    .forsubMonth {
        border-bottom: 1px solid #CCC;
        padding-bottom: 3px;
    }
    .plan-title {
        margin: 5px 0px;
    }
    .panel.price {
        border: none;
        margin: 0px;
    }  
    .panel.price, .panel.price>.panel-heading{
        border-radius:0px;
         -moz-transition: all .3s ease;
        -o-transition:  all .3s ease;
        -webkit-transition:  all .3s ease;
    }
    .panel.price:hover{
        box-shadow: 0px 0px 30px rgba(0,0,0, .2);
    }
    .panel.price:hover>.panel-heading{
        box-shadow: 0px 0px 30px rgba(0,0,0, .2) inset;
    }

    .panel.price>.panel-heading{
        box-shadow: 0px 5px 0px rgba(50,50,50, .2) inset;
        text-shadow:0px 3px 0px rgba(50,50,50, .6);
    }
        
    .price .list-group-item{
        border-bottom-:1px solid rgba(250,250,250, .5);
    }

    .panel.price .list-group-item:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .panel.price .list-group-item:first-child {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    } 
    .price .panel-footer {
        color: #fff;
        border-bottom:0px;
        background-color:  #fdfdfd; 
        padding: 5px 15px;
    } 
    .panel.price .btn{
        box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
        border:0px;
    } 
    .price.panel-grey>.panel-heading {
        color: #fff;
        background-color: #6D6D6D;
        border-color: #B7B7B7;
        border-bottom: 1px solid #B7B7B7;
    }  
    .price.panel-grey>.panel-body {
        color: #fff;
        background-color: #808080;
    } 
    .price.panel-grey>.panel-body .lead{
        text-shadow: 0px 3px 0px rgba(50,50,50, .3);
        font-size: 30px;
        margin: 0px;
    } 
    .price.panel-grey .list-group-item {
        color: #333;
        background-color: rgba(50,50,50, .01);
        font-weight:600;
        text-shadow: 0px 1px 0px rgba(250,250,250, .75);
    } 
    #priceDetails .modal-footer {
        padding: 5px 15px
    }
    #priceDetails .crop_can {
        background-color: #282828;
        color: #FFFFFF;
        font-size: 14px;
        padding: 3px 10px 4px;
    }
    .a-href {
        cursor: pointer;
    }
</style>