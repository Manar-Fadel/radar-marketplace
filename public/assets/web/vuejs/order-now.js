const app = Vue.createApp({
    data() {
        return {

            status: false,
            message: null,
            loading: true,
            brandLoading: false,
            search_word: '',

            addModal: {
                brand_id: '',
                description: '',
            },
            brands: [],
            orderImagesLoading: true,
            order_images: [],
            headers: null
        }
    },
    methods: {
        initialize () {
            const authToken = $("#auth_token").val();
            this.headers = {
                'Authorization': `Bearer ${authToken}`,
                'Content-Type': 'application/json'
            };

            this.fetchBrands();
        },
        emptyFilters () {
            this.brand_id = '';
            this.description = '';
            this.order_images = [];
            this.fetchBrands();
        },
        onBrandChange(event){
            this.fetchBrands()
        },
        async fetchBrands () {
            this.brandLoading = true;
            const response = await fetch(
                "/api/web/brands?search_word="+this.search_word,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.brands = this.response.data.brands;
            this.brandLoading = false;
        },
        async saveOrder () {
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.addModal)
            };
            const response = await fetch("/api/web/save-order", requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {

            }
        },
    }
});

const vm = app.mount("#app");
vm.initialize();
