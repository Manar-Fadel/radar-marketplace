<form method="get" action="{{ route("admin.offers.export") }}">
    <div class="container-fixed flex flex-wrap gap-2.5 mr-6 lg:gap-5 mr-6 pb-2.5">
        <input name="search_word" id="search_word"
               v-model="search_word" :name="search_word" :id="search_word" value="{{ isset($_GET['search_word']) ? $_GET['search_word'] : '' }}"
               placeholder="Search by offer number or description.." class="input w-[285px]" />

        <select name="offer_status" id="offer_status"
                v-model="offer_status" :name="offer_status" :id="offer_status" class="select select-sm w-28">
            <option value="">
                Status
            </option>
            @foreach($offer_statuses as $status)
                <option value="{{ $status->name }}">
                    {{ $status->value }}
                </option>
            @endforeach
        </select>

        <select name="attach_required_status" id="attach_required_status"
                v-model="attach_required_status" :name="attach_required_status" :id="attach_required_status" class="select select-sm w-28">
            <option value="">
                Attach Status
            </option>
            @if(request()->route()->getName() == "admin.offers.requested")
                @foreach($attach_requested_statuses as $attach_required_status)
                    <option value="{{ $attach_required_status->name }}">
                        {{ $attach_required_status->value }}
                    </option>
                @endforeach
            @else
                @foreach($attach_required_statuses as $attach_required_status)
                    <option value="{{ $attach_required_status->name }}">
                        {{ $attach_required_status->value }}
                    </option>
                @endforeach
            @endif
        </select>

        <select name="year" id="year"
                v-model="year" :name="year" :id="year" class="select select-sm w-28">
            <option value="">
                Year
            </option>
            @foreach($years as $year)
                <option value="{{ $year }}" {{ isset($_GET['year']) && $_GET['year'] == $year ? "selected":"" }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <select name="month" id="month"
                v-model="month" :name="month" :id="month" class="select select-sm w-28">
            <option value="">
                Month
            </option>
            @foreach($months as $key => $month)
                <option value="{{ $key }}" {{ isset($_GET['month']) && $_GET['month'] == $key ? "selected":"" }}>
                    {{ $month }}
                </option>
            @endforeach
        </select>

        <select name="week" id="week" v-if="user_id == null" v-model="week" :name="week" :id="week" class="select select-sm w-28">
            <option value="">
                Week
            </option>
            @foreach($weeks as $key => $week)
                <option value="{{ $key }}" {{ isset($_GET['week']) && $_GET['week'] == $key ? "selected":"" }}>
                    {{ $week }}
                </option>
            @endforeach
        </select>

        <button @click="emptyOffersFilters();" type="button" class="btn btn-sm btn-outline btn-warning mr-5" style="float: right;">
            <i class="ki-filled ki-trash">
            </i>
            clear Filters
        </button>
        <button @click="fetchOffers();" type="button" class="btn btn-sm btn-outline btn-primary mr-5" style="float: right;">
            <i class="ki-filled ki-setting-4">
            </i>
            Filters
        </button>
        <button type="submit" class="btn btn-sm btn-outline btn-light mr-5" style="float: right;">
            <i class="ki-filled ki-cloud-download text-gray-500 text-lg"></i>
            Export CSV
        </button>
    </div>
</form>
