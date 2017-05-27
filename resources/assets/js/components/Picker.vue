<template>
    <div id="picker-container">
        <slick ref="slick" :options="slickOptions" @init="setSlide(0)" @afterChange="afterChange">
          <a  v-for="item in itemList" :href="item.img"><img class="img-responsive" :src="item.img" alt=""></a>
        </slick>

        <div class="picker-actions clearfix">
          <div class="tags">
          </div>
          <div class="pull-right">
            <div class="btn btn-default" @click="next()">Next</div>
            <div class="btn btn-primary" @click="pick(index)">Like</div>
          </div>
        </div>

        <div class="well" id="info">
            <h3 class="info-title">{{current.name}}</h3>

            <p class="info-bio">
                {{current.bio}}
            </p>
        </div>
    </div>
</template>

<script>

    export default {


        components: { Slick },


        data (){
            return {
                current : {
                  name : '',
                  img : '',
                  bio : ''
                },
                index : 0,
                slickOptions : {
                  infinite: false,
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
                },
                itemList : [
                  {
                    name : 'Lorem ipsum 1',
                    img : 'http://lorempixel.com/640/640/people?q123',
                    bio : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, reokeokr,'
                  },
                  {
                    name : 'Lorem ipsum 2',
                    img : 'http://lorempixel.com/640/640/people?q456',
                    bio : 'us. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum pur'
                  },
                  {
                    name : 'Lorem ipsum 3',
                    img : 'http://lorempixel.com/640/640/people?q789',
                    bio : 'Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus'
                  },
                  
                ]
            }
        },
        methods:{
            next() {
                this.$refs.slick.next();
            },

            prev() {
                this.$refs.slick.prev();
            },
            afterChange(event, slick, currentSlide){
              this.setSlide(currentSlide);
            },
            setSlide(index){
              this.current = this.itemList[index];
              this.index = index;
            },

            pick(index){
                console.log('picked : ' + index);
            },

            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                this.$refs.slick.reSlick();
            },

        }
    }
</script>
