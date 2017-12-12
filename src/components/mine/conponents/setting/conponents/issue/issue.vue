<template>
    <div class="content">
        <div class="list-block" style="margin-top:10px;">
          <ul>
            <li>
                <div class="item-inner">
                    <div class="item-title">  如何使用客户端app购物?</div>
                    <span class="icon icon-right"></span>
                </div>
                <div class="details">
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                </div>
            </li>
            <li>
                <div class="item-inner">
                    <div class="item-title"> 如何查询订单?</div>
                    <span class="icon icon-right"></span>
                </div>
                <div class="details">
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                </div>
            </li>
            <li>
                <div class="item-inner">
                    <div class="item-title"> 如何修改订单?</div>
                    <span class="icon icon-right"></span>
                </div>
                <div class="details">
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                </div>
            </li>
            <li>
                <div class="item-inner">
                    <div class="item-title"> 如何取消订单?</div>
                    <span class="icon icon-right"></span>
                </div>
                <div class="details">
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                </div>
            </li>
            <li>
                <div class="item-inner">
                    <div class="item-title"> 如何进行退换货?</div>
                    <span class="icon icon-right"></span>
                </div>
                <div class="details">
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                </div>
            </li>
            <li>
                <div class="item-inner">
                    <div class="item-title"> 取消订单/退货后,款项如何退回?</div>
                    <span class="icon icon-right"></span>
                </div>
                <div class="details">
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                    内容内容内容内容内容内容内容内容内容内容内容内容内容
                </div>
            </li>
          </ul>
        </div>        
    </div>
</template>
<script type="text/javascript">
    import './issue.scss';
    jQuery(function($){
        $(document).on("click", ".item-inner", function(){
            var $item_m=$(this).parent().find('.details')
            if($item_m.is(':visible')){
                $item_m.slideUp(200)
            }else{
                $item_m.slideDown(200);
            }
        })
    });
    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';
    export default{
      data(){
        return {
            toolbar:'常见问题',
            backrouter:'setting'
        }
      },
      mounted:function(){
          this.$parent.initToolbar(this.toolbar,this.backrouter);
      }

    }    
</script>
