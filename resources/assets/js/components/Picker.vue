<template>
    <div id="picker-container">

        <slick ref="slick" :options="slickOptions" @afterChange="afterChange">
          <a  v-for="item in itemList" href="javascript:;"><img class="img-responsive" :src="item.details.profile" alt=""></a>

        </slick>

        <div class="well" id="info">

          <div class="picker-actions row clearfix">

              <div class="pull-left btn-like">
                <div class="btn btn-primary" :class="{matched : current.matched}" @click="pick(index)">
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

                matchUrl : '/app/matches',
                current : {
                  id: '',
                  name : '',
                  details : {
                    profile : '',
                    bio : ''
                  },
                  matched: 0
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
        props : ['list', 'user'],
        computed: {
          itemList : function(){
            return  JSON.parse(this.list);
          },
          volunteer : function(){
            return  JSON.parse(this.user);
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

                if(this.current.matched){
                  // Remove match
                  this.deleteMatch();
                } else {
                  // Create
                  this.createMatch();
                }              

                
            },
            createMatch(){

              let obj = {
                  customCloseBtnText : 'Sluiten',
                  customCloseBtnClass: 'btn btn-primary',
                }

                let body = {
                  user_id : this.volunteer.id,
                  client_id : this.current.id,
                }

                this.$http.post(this.matchUrl, body).then(res =>{

                    obj.title = 'Bedankt!';
                    obj.message = res.data.message;
                    obj.type = 'success';

                    this.current.matched = 1;

                  this.$refs.simplert.openSimplert(obj)

                }).catch(e => {

                    obj.title = 'Uh oh.';
                    obj.message = e.response.data.message;
                    obj.type = 'error';
                    if(e.response.status === 400){
                      obj.type = 'warning';
                    }
                  this.$refs.simplert.openSimplert(obj)
                });
            },
            deleteMatch(){
              let obj = {
                  customCloseBtnText : 'Sluiten',
                  customCloseBtnClass: 'btn btn-primary',
                }
                let data = {
                  data : {
                    user_id : this.volunteer.id,
                    client_id : this.current.id,
                  }
                }

                this.$http.delete(this.matchUrl, data).then(res =>{

                    obj.title = 'Ongedaan';
                    obj.message = res.data.message;
                    obj.customIconUrl = '';

                    this.current.matched = 0;

                  this.$refs.simplert.openSimplert(obj)

                }).catch(e => {

                    obj.title = 'Uh oh.';
                    obj.message = e.response.data.message;
                    obj.type = 'error';
                    if(e.response.status === 400){
                      obj.type = 'warning';
                    }
                  this.$refs.simplert.openSimplert(obj)
                });
            }
        }
    }
</script>
