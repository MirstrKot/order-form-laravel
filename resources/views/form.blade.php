<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css">
        <title>Форма заказа</title>
    </head>
    <body>
        <div class="container" id="app">
            <div class="loader" v-if="!isLoaded"></div>
            <div class="row">
                <div class="col">
                    <h1 class="main_header">Оформление заказа</h1>
                </div>
            </div>
            <div class="row" v-if="!successData">
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form @submit.prevent="sendRequest">
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   v-bind:class="{ 'is-invalid': submitErrors && submitErrors.name}"
                                   id="input_name"
                                   placeholder="Укажите имя"
                                   name="name"
                                   v-model="formData.name"
                                   maxlength="255"
                                   @input="clearSubmitError">
                        </div>
                        <div class="form-group">
                            <the-mask mask="+7 (###) ###-##-##"
                                      placeholder="Укажите телефон"
                                      type="tel"
                                      class="form-control"
                                      v-bind:class="{ 'is-invalid': submitErrors && submitErrors.phone}"
                                      v-model="formData.phone"
                                      @input="clearSubmitMaskedError"></the-mask>
                        </div>
                        <div class="form-group">
                            <select class="form-control"
                                    v-bind:class="{ 'is-invalid': submitErrors && submitErrors.plan_id}"
                                    id="select_plan"
                                    name="plan_id"
                                    v-model="formData.plan_id"
                                    @change="clearSubmitError" >
                                <option disabled selected="selected" value="0">Выберите тариф</option>
                                <option v-for="plan in plans" v-bind:value="plan.id">@{{ plan.name }} @{{ plan.price }} руб.</option>
                            </select>
                            <small class="form-text" v-for="plan in plans" v-if="plan.id == formData.plan_id">@{{ plan.description }}</small>
                            <div class="form-text text-muted" v-for="plan in plans" v-if="plan.id == formData.plan_id">
                                <small>Доставка осуществляется по</small>
                                <div>
                                    <span v-for="day in plan.days_array" class="day_available">@{{ daysOfWeek[day] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" v-if="formData.plan_id">
                            <vuejs-datepicker
                                    v-model="formData.date"
                                    v-bind:input-class="{ 'is-invalid': submitErrors && submitErrors.date, 'form-control': true}"
                                    placeholder="Укажите день первой доставки"
                                    format="dd.MM.yyyy"
                                    :monday-first="true"
                                    @input="clearSubmitDatepickerError"
                                    :disabled-dates="disabledDates"></vuejs-datepicker>
                        </div>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   v-bind:class="{ 'is-invalid': submitErrors && submitErrors.address }"
                                   id="input_address"
                                   placeholder="Укажите адрес"
                                   name="address"
                                   v-model="formData.address"
                                   @change="addressChanged"
                                   @input="clearSubmitError">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" v-bind:disabled="isSubmiting">Заказать</button>
                        </div>
                        <div v-if="submitErrors" class="text-danger form-group">Исправьте ошибки в подсвеченных полях</div>
                        <div v-if="isCriticalError" class="text-danger form-group">Неизвестная ошибка при отправке формы, попробуйте отправить позже</div>
                    </form>
                </div>
            </div>
            <div class="row" v-if="successData">
                <div class="col text-success">
                    Поздравляем, @{{ successData.name }}, заказ успешно оформлен. Мы свяжемся с вами по телефону +7@{{ successData.phone }} для уточнения деталей заказа.
                </div>
            </div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdghxpYPQ7rZNmi3nBXCp8r3pHDW2GITc&libraries=places" type="text/javascript"></script>
        <script src="/js/address.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/vuejs-datepicker"></script>
        <script src="https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="/js/vue_app.js"></script>
    </body>
</html>
