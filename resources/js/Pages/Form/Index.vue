<template>
    <Head title="DASS Metal Request Quote" />
    <div class="container">
        <div class="row">
        <form @submit.prevent="submitData"  class="py-3 dass-form">
            <div class="row">
                <div class="col-12">
                    <b-form-input type="text" class="rounded my-3" v-model="form.name" placeholder="Name" required></b-form-input>
                    <b-form-input type="email" class="rounded my-3" v-model="form.email" placeholder="Email" required></b-form-input>
                    <b-form-input type="text" class="rounded my-3" v-model="form.phone" placeholder="Phone Number"></b-form-input>
                    <b-form-input type="text" class="rounded my-3" v-model="form.company" placeholder="Company Name" required></b-form-input>
                    <b-form-input type="text" class="rounded my-3" v-model="form.address" placeholder="Project Address" required></b-form-input>
                    <b-form-input type="text" class="rounded my-3" v-model="form.project_name" placeholder="Project Name" required></b-form-input>
                    <b-form-textarea rows="3" type="text" class="rounded my-3" v-model="form.comments" placeholder="Comments"></b-form-textarea>
                    
                </div>
            </div>

            <div class="text-left">
                <b-button variant="light" class="accent-color border-0 rounded text-white" @click="addBox()">
                    <i class="fas fa-plus mx-1" />
                    Add Item
                </b-button>
            </div>

            <div class="table-responsive-xl">
                <table class="table my-3" v-if="form.items.length > 0">
                    <thead>
                        <th class="text-muted" style="font-weight: 300">Quantity</th>
                        <th class="text-muted" style="font-weight: 300">Width</th>
                        <th class="text-muted" style="font-weight: 300">Item</th>
                        <th class="text-muted" style="font-weight: 300">Mil</th>
                        <th class="text-muted" style="font-weight: 300">Feet</th>
                        <th class="text-muted" style="font-weight: 300">Inches</th>
                        <th class="text-muted" style="font-weight: 300">Instructions</th>
                        <th class="text-muted" style="font-weight: 300">Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(box, key) in form.items" :key="key" class="align-items-center">
                            <td>
                                <div class="d-flex flex-row">
                                    <b-form-input class="rounded" v-model="box.quantity" :id="'name'+key" type="number" step="1"
                                            placeholder="Qty" required>
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <b-form-input step="0.1" min="0" type="number" class="rounded-0" v-model="box.width" 
                                            placeholder="Width" required>
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <b-form-input type="text" class="rounded" v-model="box.item" 
                                            placeholder="Product name" required>
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <b-form-input step="1" min="0" type="number" class="rounded" v-model="box.mil" 
                                            placeholder="Mil" required>
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-row">
                                    <b-form-input step="1" min="0" type="number" class="rounded" v-model="box.feet" 
                                            placeholder="Feet" required>
                                        
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <b-form-input step="0.1" min="0" type="number" class="rounded" v-model="box.inches" 
                                            placeholder="Inches" required>
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <b-form-input type="text" class="rounded" v-model="box.instructions" 
                                            placeholder="Instructions">
                                    </b-form-input>
                                </div>
                            </td>
                            <td>
                                <b-button variant="light" class="bg-white rounded" @click="removeBox(key)" >
                                    <i class="fas fa-trash mx-1" />
                                </b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-left">
                <b-button type="submit" class="accent-color border-0 rounded text-white mt-4 px-5">
                    <span style="font-size: 16px">
                        Send
                    </span>
                    <i class="fas fa-chevron-right mx-2"></i>
                </b-button>
            </div>
        </form>   
        </div>

        <div>
            <flash />
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Flash from '../../Shared/Flash'
export default {
  components: {
      Head,
      Flash,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        email: null,
        phone: null,
        company: null,
        address: null,
        project_name: null,
        comments: null,
        items: [],
      }),
    }
  },
  methods: {
    submitData() {
      this.form.post('/store-form', {
        onSuccess: (page) => {
            console.log('page', this.$page.props.errors, this.$page.props.flash);

            if (this.$page.props.flash.error) {
                this.$page.props.flash.error = 'Something went wrong!';
                this.$page.props.flash.success = null;
            }
            else if (this.$page.props.flash.success) {
                this.$page.props.flash.success = 'Sent Successfully';
                this.$page.props.flash.error = null;
            }

            this.reset();
        },
      });
    },
    reset() {
        this.form.name = null;
        this.form.email = null;
        this.form.phone = null;
        this.form.company = null;
        this.form.address = null;
        this.form.project_name = null;
        this.form.components = null;
        this.form.items = [];
    },
    addBox() {
        this.form.items.push({
            quantity: null, 
            width: null, 
            item: null, 
            mil: null, 
            feet: null,
            inches: null,
            instructions: null,
        });
    },
    check(x) {
        return parseInt(x) > 0.1;
    },

    checkweight(x) {
        return parseInt(x) > 0.1;
    },

    removeBox(key) {
        this.form.items.splice(key, 1);
    },
  },
}
</script>
<style scoped>
.accent-color {
    background-color: #355181;
}

tbody {
    border: none !important;
}

td {
    min-width: 120px;
}
</style>
<style>
.dass-form .form-control {
    transition: 0.4s;
}

.dass-form .form-control:focus {
    box-shadow: none;
    border: 1px solid black;
}
</style>