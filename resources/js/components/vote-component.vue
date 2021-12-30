<template>
    <div>
        <field>
            <button class="button is-white is-success" v-on:click="like">
                <span>like</span>
            </button>

            <button class="button is-white is-warning" v-on:click="dislike">
                <span>meh</span>
            </button>

            <button class="button is-danger" v-on:click="hate">
                <span>This Poem is Hate Speech</span>
            </button>
        </field>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                 likeRocker: ''
            }
        },

    methods:{
        like: function(){console.log('like'); },
        dislike: function(){console.log('dislike');},
        hate:function(){ console.log('hate'); }
    }

    }
</script>
