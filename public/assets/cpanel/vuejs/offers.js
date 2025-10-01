const app = Vue.createApp({
    data() {
        return {
            isFromViewUser: false,
            offers_per_page : 10,
            offers_current_page : 1,

            status: false,
            message: null,
            loading: true,
            user_id: null,
            user_type: null,

            search_word: "",
            offer_status: "",
            attach_required_status: "",
            year: "",
            month: "",
            week: "",

            response: null,
            lists: [],
            editModal: null,
            index: null,
            key: null,

            part: null,
            isFromListingNotes: false,
            paymentsLoading: true,
            payments: [],

            logsLoading: true,
            part_logs: [],

            offersLoading: true,
            offers: [],

            customerCareNotesLoading: true,
            customer_care_notes: [],

            partImagesLoading: true,
            part_images: [],
            voice_note: null,
            video_note: null,

            uploadOfferAttachmentModal: null,
            uploadOfferAttachmentLoading: false,

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

            this.fetchOffers();
        },
        emptyOffersFilters () {
            this.search_word = "";
            this.offer_status = "";
            this.attach_required_status = "";
            this.year = "";
            this.month = "";
            this.week = "";
            this.fetchOffers();
        },
        async fetchOffers (){
            this.loading = true;
            const response = await fetch(
                "/api/admin/offers?search_word="+this.search_word+"&offer_status="+this.offer_status+"&year="+this.year+"&month="+this.month+"&week="+this.week+"&attach_required_status="+this.attach_required_status,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.lists = this.response.lists;
            this.loading = false;
        },
        async getConstants () {
            const response = await fetch(
                "/api/admin/offers/constants",
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.state_options = this.response.state_options;
            this.condition_options = this.response.condition_options;
            this.original_statuses = this.response.original_statuses;
        },
        async editOffer (row, key, index) {
            this.editModal = row;
            this.key = key;
            this.index = index;
        },
        async storeOffer (row, key, index) {
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.editModal)
            };
            const response = await fetch("/api/admin/offers/update/"+row.id, requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            window.scroll(0,0);
            if (this.status) {
                $(".close-link").click();
                this.lists[key].splice(index, 1, this.response.offer);
            }
        },
        async deleteOffer (row, key, index) {
            const response = await fetch(
                "/api/admin/offers/delete/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status){
                this.lists[key].splice(index, 1);
            }
        },
        showOffers(divID){
            $(".activity-content").addClass("hidden");
            $("#"+divID).removeClass('hidden');

            $(".activity-link").removeClass("active");
            //$("#"+linkID).addClass("active");
        },
        async editCustomerCareNotes (row, key, index) {
            this.addCustomerCareNoteModal = row;
            this.key = key;
            this.index = index;
        },
        async postEditCustomerCareNotes (row, key, index) {
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.addCustomerCareNoteModal)
            };
            const response = await fetch("/api/admin/customer-care-notes/update/"+row.id, requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                $(".close-link").click();
                window.scroll(0,0);
                this.customer_care_notes.splice(index, 1, this.response.customer_care_note);
            }
        },
        async getPartLogs(id) {
            const response = await fetch(
                "/api/admin/orders/logs/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.part_logs = this.response.logs;
            this.logsLoading = false;
        },
        async getPartCustomerCareNotes(id) {
            const response = await fetch(
                "/api/admin/orders/customer-care-notes/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.customer_care_notes = this.response.customer_care_notes;
            this.customerCareNotesLoading = false;
        },
        async getPartOffers(id) {
            const response = await fetch(
                "/api/admin/orders/offers/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.offers = this.response.offers;
            this.offersLoading = false;
        },
        async getPartPayments(request_id, id) {
            const response = await fetch(
                "/api/admin/orders/payments/"+request_id+"/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.payments = this.response.payments;
            this.paymentsLoading = false;
        },
        async deleteOrderVoice (row) {
            const response = await fetch(
                "/api/admin/orders/delete-voice/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            this.voice_note = null;
        },
        async deleteOrderVideo (row) {
            const response = await fetch(
                "/api/admin/orders/delete-video/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            this.video_note = null;
        },
        async deletePartImage (part, image) {
            const response = await fetch(
                "/api/admin/orders/delete-image/"+image.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.part_images = this.response.images
            }
        },
        async getPartImages(id) {
            const response = await fetch(
                "/api/admin/orders/images/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.part_images = this.response.data.images;
            this.voice_note = this.response.data.voice_note;
            this.video_note = this.response.data.video_note;
            this.partImagesLoading = false;
        },
        viewModal (part) {
            this.part = part;
            this.offersLoading = true;
            this.logsLoading = true;
            this.paymentsLoading = true;

            this.offers = [];
            this.payments = [];
            this.part_logs = [];
            this.customer_care_notes = [];
            this.part_images = [];

            this.getPartImages(part.id);
            this.getPartLogs(part.id);
            this.getPartOffers(part.id);
            this.getPartCustomerCareNotes(part.id);
            this.getPartPayments(part.request_id, part.id);
        },
        async deleteOfferVoice (row, key, index) {
            const response = await fetch(
                "/api/admin/offers/delete-voice/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.lists[key].splice(index, 1, this.response.offer);
            }
        },
        async deleteOfferVideo (row, key, index) {
            const response = await fetch(
                "/api/admin/offers/delete-video/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.lists[key].splice(index, 1, this.response.offer);
            }
        },
        async deleteOfferImage (image, key, index) {
            const response = await fetch(
                "/api/admin/offers/delete-image/"+image.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.lists[key].splice(index, 1, this.response.offer);
            }
        },
        async uploadOfferAttachment (row, key, index) {
            this.uploadOfferAttachmentModal = row;
            this.key = key;
            this.index = index;
        },
        onFileChange(e) {
            this.file = e.target.files[0];
        },
        async saveUploadedOfferAttachment (row) {
            this.uploadOfferAttachmentLoading = true;
            const formData = new FormData();
            formData.append('file', this.file);

            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: formData
            };
            const response = await fetch("/api/admin/offers/upload-attachment/"+row.id, requestOptions);
            this.uploadOfferAttachmentLoading = false;
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                $(".close-link").click();
                window.scroll(0,0);
                this.lists[this.key].splice(this.index, 1, this.response.data.offer);
            }
        },
    }
});

const vm = app.mount("#app");
vm.initialize();
