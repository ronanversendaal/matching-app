<template>
    <div id="picker-container">

        <slick ref="slick" :options="slickOptions" @afterChange="afterChange">
          <a  v-for="item in itemList" href="javascript:;"><img class="img-responsive" :src="item.details.profile" alt=""></a>

        </slick>

        <div class="well" id="info">

          <div class="picker-actions row clearfix">

              <div class="pull-left btn-like">
                <div class="btn btn-primary" @click="pick(index)">
                  <span class="glyphicon glyphicon-thumbs-up"></span>
                </div>
              </div>
              <div class="text-center" style="position: absolute; left: 50%;
    transform: translateX(-50%);">
                <div class="btn btn-default"  @click="showBio(index)">
                 <span class="glyphicon glyphicon-info-sign"></span> <span>Info</span>
                </div>
              </div>
              <div class="pull-right">
                <div class="btn btn-default btn-next" @click="next()">&nbsp;</div>
              </div>
          </div>

            <h6 class="info-title">{{current.name}}</h6>
              <p class="info-bio">
                  {{current.details.description}}
              </p>
            <div class="tags">
            </div>
        </div>
        <simplert
                  useIcon=true
                  ref="simplert">
        </simplert>
    </div>
</template>

<script>

    export default {


        components: { Slick, Simplert },


        data (){
            return {
                current : {
                  name : '',
                  details : {
                    profile : '',
                    bio : ''
                  }
                },
                index : 0,
                slickOptions : {
                  arrows: false,
                  infinite: true,
                  touchMove : false,
                  draggable: false,
                  swipeToSlide: false,
                  centerMode: true,
                  centerPadding: '0',
                  respondTo: 'slider',
                  initialSlide : 0,
                  slidesToShow: 1,
                  responsive: [
                    {
                      breakpoint: 768,
                      settings: {
                        arrows: false,
                        centerMode: true,
                        slidesToShow: 1
                      }
                    },
                    {
                      breakpoint: 640,
                      settings: {
                        arrows: false,
                        centerMode: true,
                        slidesToShow: 1
                      }
                    },
                  ]
                }
            }
        },
        props : ['list'],
        computed: {
          itemList : function(){
            return  JSON.parse(this.list);
          }
        },
        mounted(){
          this.setSlide(0);
        },
        methods:{
            showBio(index){

              let obj = {
                  title: this.itemList[index].name,
                  message: this.itemList[index].details.bio, //@todo Max 600 for style purposes
                  type: 'info',
                  customCloseBtnText : 'Sluiten',
                  customCloseBtnClass: 'btn btn-primary',
                  customIconUrl : '/img/logo-icon-44.png'
                }
                this.$refs.simplert.openSimplert(obj)
            },
            next() {
                this.$refs.slick.next();
            },
            afterChange(event, slick, currentSlide){
              this.setSlide(currentSlide);
            },
            setSlide(index){
              this.current = this.itemList[index];
              this.index = index;
            },

            pick(index){

                let obj = {
                  title: 'Bedankt!',
                  message: 'Je aanvraag is in behandeling.',
                  type: 'success',
                  customCloseBtnText : 'Sluiten',
                  customCloseBtnClass: 'btn btn-primary',
                }
                this.$refs.simplert.openSimplert(obj)
            },
        }
    }
</script>
