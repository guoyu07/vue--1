<template>
    <ul class="mo-paging">
        <li
        :class="['paging-item', 'paging-item--first', {'paging-item--disabled' : index === 1}]"
        @click="first">首页</li>
        <li
        :class="['paging-item', 'paging-item--prev', {'paging-item--disabled' : index === 1}]"
        @click="prev">上一页</li>
        <li
        :class="['paging-item', 'paging-item--more']"
        v-if="showPrevMore">...</li>

        <li
        :class="['paging-item', {'paging-item--current' : index === pager}]"
        v-for="pager in pagers"
        @click="go(pager)">{{ pager }}</li>

        <li
        :class="['paging-item', 'paging-item--more']"
        v-if="showNextMore">...</li>
        <li
        :class="['paging-item', 'paging-item--next', {'paging-item--disabled' : index === pages}]"
        @click="next">下一页</li>
        <li
        :class="['paging-item', 'paging-item--last', {'paging-item--disabled' : index === pages}]"
        @click="last">最后一页</li>
        
    </ul>
</template>
<script>
    export default {
        name : 'MoPaging',
        props : {
            perPages : { 
                type : Number,
                default : 5 
            },

            pageIndex : {
                type : Number,
                default : 1
            },
            pageSize : {
                type : Number,
                default : 10
            },

            total : {
                type : Number,
                default : 1
            },
        },
        data(){
            return {
                index : this.pageIndex, //当前页码
                limit : this.pageSize, //每页显示条数
                size : this.total || 1, //总记录数
                showPrevMore : false,
                showNextMore : false
            }
        }, 
        methods:{
            prev(){
                if (this.index > 1) {
                    this.go(this.index - 1)
                }
            },
            next(){
                if (this.index < this.pages) {
                    this.go(this.index + 1)
                }
            },
            first(){
                if (this.index !== 1) {
                    this.go(1)
                }
            },
            last(){
                if (this.index != this.pages) {
                    this.go(this.pages)
                }
            },
            go (page) {
                if (this.index !== page) {
                    this.index = page
                    //父组件通过change方法来接受当前的页码
                    this.$emit('change', this.index)
                }
            }
        },
        computed : {
            pages(){
                return Math.ceil(this.size / this.limit);
            },
            pagers () {
                const array = []
                const perPages = this.perPages
                const pageCount = this.pages
                let current = this.index
                const _offset = (perPages - 1) / 2

                
                const offset = {
                    start : current - _offset,
                    end   : current + _offset
                }

                //-1, 3
                if (offset.start < 1) {
                    offset.end = offset.end + (1 - offset.start)
                    offset.start = 1
                }
                if (offset.end > pageCount) {
                    offset.start = offset.start - (offset.end - pageCount)
                    offset.end = pageCount
                }
                if (offset.start < 1) offset.start = 1

                this.showPrevMore = (offset.start > 1)
                this.showNextMore = (offset.end < pageCount)

                for (let i = offset.start; i <= offset.end; i++) {
                    array.push(i)
                }
                return array
            }
        },
        watch:{
            pageIndex(val) {
                this.index = val || 1
            },
            pageSize(val) {
                this.limit = val || 10
            },
            total(val) {
                this.size = val || 1
            }
        }
    }
</script>
<style>
    .mo-paging {
  display: inline-block;
  padding: 0;
  margin: 1rem 0;
  font-size: 0;
  list-style: none;
  user-select: none; }
  .mo-paging > .paging-item {
    display: inline;
    font-size: 14px;
    position: relative;
    padding: 6px 12px;
    line-height: 1.42857143;
    text-decoration: none;
    border: 1px solid #ccc;
    background-color: #fff;
    margin-left: -1px;
    cursor: pointer;
    color: #0275d8; }
    .mo-paging > .paging-item:first-child {
      margin-left: 0; }
    .mo-paging > .paging-item:hover {
      background-color: #f0f0f0;
      color: #0275d8; }
    .mo-paging > .paging-item.paging-item--disabled, .mo-paging > .paging-item.paging-item--more {
      background-color: #fff;
      color: #505050; }
    .mo-paging > .paging-item.paging-item--disabled {
      cursor: not-allowed;
      opacity: .75; }
    .mo-paging > .paging-item.paging-item--more, .mo-paging > .paging-item.paging-item--current {
      cursor: default; }
    .mo-paging > .paging-item.paging-item--current {
      background-color: #0275d8;
      color: #fff;
      position: relative;
      z-index: 1;
      border-color: #0275d8; }

</style>