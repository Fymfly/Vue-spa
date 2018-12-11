<template>
    <div>
        <header class="top-header fixed-header">
            <a class="icona" href="javascript:history.go(-1)">
                    <img src="../assets/images/left.png"/>
            </a>
            <h3>去结算</h3>
            <a class="iconb" href="shopcar.html">
            </a>
        </header>
        
        <div class="contaniner fixed-cont">
            <section class="to-buy">
                <header>
                    <div v-for="(v,k) in " class="now" v-if="defaultAddress">
                        <span><img src="../assets/images/map-icon.png"/></span>
                            <dl>
                                <dt>
                                    <b>{{defaultAddress.name}}</b>
                                    <strong>{{defaultAddress.tel}}</strong>
                                </dt>
                                <dd>{{defaultAddress.province+" "+defaultAddress.city+" "+defaultAddress.area+" "+defaultAddress.address}}</dd>
                                <p>其他地址</p>
                            </dl>
                    </div>
                    
                    <div v-for="(v,k) in address" :key="k" class="to-now">
                        <div class="tonow">
                            <label @click="addSelectedId=v.id" :class="{'ton':addSelectedId==v.id}" for="tonow"  onselectstart="return false" ></label>
                            <input type="checkbox" id="tonow"/>
                        </div>
                        <dl>
                            <dt>
                                <b>{{v.name}}</b>
                                <strong>{{v.tel}}</strong>
                            </dt>
                            <dd>{{v.province+" "+v.city+" "+v.area+" "+v.address}}</dd>
                        </dl>
                        <h3><a href="go-address.html"><img src="../assets/images/write.png"/></a></h3>
                    </div>
                </header>
                <div class="buy-list">
                    <ul>
                        <a href="detail.html">
                            <figure>
                                <img src="../assets/images/detail-pp01.png"/>
                            </figure>
                            <li>
                                <h3>超级大品牌服装，现在够买只要998</h3>
                                <span>
                                    颜色：经典绮丽款
                                    <br />
                                    尺寸：M
                                </span>
                                <b>￥32.00</b>
                                <small>×3</small>
                            </li>
                        </a>
                    </ul>
                    <dl>
                        <dd>
                            <span>运费</span>
                            <small>包邮</small>
                        </dd>
                        <dd>
                            <span>商品总额</span>
                            <small>￥98.00</small>
                        </dd>
                        <dt>
                            <textarea rows="4" placeholder="给卖家留言（50字以内）"></textarea>
                        </dt>
                    </dl>
                </div>
                
            </section>
            <!--底部不够-->
            <div style="margin-bottom: 9%;"></div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            defaultAddress: {},
            addSelectedId: '',      // 当前被勾选的地址
            address: []
        }
    },
    created() {

        
        this.axios.get('/address').then(res=>{

                if(res.data.status_code == 403) {

                    this.$router.push('/login')
                } else {

                    // 找出默认的地址
                    let defaultAdd = res.data.data.find(v => v.is_default==1)
                    if(!defaultAdd)

                        this.defaultAddress = res.data.data[0]
                    this.addSelectedId = this.defaultAddress.id
                    this.address = res.data.data
                }
                // console.log( res.data )
            })
    }
}
</script>

