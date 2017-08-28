L.Control.Search = L.Control.extend({
    that: this,
    options: {
        // topright, topleft, bottomleft, bottomright
        position: 'topleft',
        placeholder: 'Quartier...'
    },
    fuse_options: {
        shouldSort: true,
        tokenize: true,
        includeScore: true,
        includeMatches: true,
        threshold: 0.4,
        location: 0,
        distance: 100,
        maxPatternLength: 32,
        minMatchCharLength: 4,
        keys: [
            "properties.nom",
            "properties.adresse",
            "properties.region",
            "properties.departement",
            "properties.commune"
        ]
    },

    initialize: function (options /*{ data: {...}  }*/) {
        // constructor
        L.Util.setOptions(this, options);
        this.loadGoogleApi();
    },
    setSearchData: function (data) {
        this.options.data = data;
        return this.options.data.length > 1;
    },
    onAdd: function (map) {
        // happens after added to map
        var container = L.DomUtil.create('div', 'search-container');
        container.style.cssText = 'max-width: 250px; min-width: 250px; ';
        this.form = L.DomUtil.create('form', 'form', container);
        var group = L.DomUtil.create('div', 'form-group', this.form);
        this.input = L.DomUtil.create('input', 'ddy_search_place', group);
        this.input.type = 'search';
        this.input.placeholder = this.options.placeholder;
        this.results = L.DomUtil.create('div', 'content list', group);
        var shopList = L.DomUtil.create('div', 'list-group', container);
        shopList.style.cssText = 'min-height: 350px; background-color: rgba(236, 240, 241,0.85);';
        L.DomEvent.addListener(this.input, 'keyup', _.debounce(this.keyup, 300), this);
        L.DomEvent.addListener(this.input, 'focusout', function (e) {
            var elem = e.target
            if (elem.value != "" && elem.value.length > 2) {
                e.preventDefault();
                elem.focus();
            }
        }, this);
        L.DomEvent.addListener(this.input, 'dblclick', function (e) {
            e.target.focusout();
        });
        L.DomEvent.addListener(this.form, 'submit', this.submit, this);
        L.DomEvent.disableClickPropagation(container);
        return container;
    },
    onRemove: function (map) {
        // when removed
        L.DomEvent.removeListener(this._input, 'keyup', this.keyup, this);
        L.DomEvent.removeListener(form, 'submit', this.submit, this);
    },
    keyup: function (e) {
        // console.log(e.target.value);
    },
    itemSelected: function (e) {
        L.DomEvent.preventDefault(e);
        var elem = e.target;
        var value = elem.innerHTML;
        var searchString = value; //elem.getAttribute('data-result-name');

        var feature = _.find(this.options.data, function (x) {
            return x.properties.nom === searchString;
        }, this);

        if (feature) {
            this._map.flyTo(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), 18);
        }
        this.results.innerHTML = '';
    },
    submit: function (e) {
        L.DomEvent.preventDefault(e);
    },
    loadGoogleApi: function () {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAr-Ecd4ShkBlVGNw2y7JzmrV_mByqv_RI';
        // if (callback){
        //     script.onreadystatechange = callback;
        //     script.onload = script.onreadystatechange;
        // }

        script.onload = function () {
            console.log(this);
            var options = {
                types: ['(regions)'],
                componentRestrictions: {country: 'sn'}
            };

            var searchBox = document.getElementsByClassName('ddy_search_place')[0];

            console.log(searchBox);


            autocomplete = new google.maps.places.Autocomplete(searchBox, options);
        };

        document.body.appendChild(script);
    }

});

L.control.search = function (id, options) {
    return new L.Control.Search(id, options);
}
