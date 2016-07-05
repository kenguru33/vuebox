<template>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: right"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="panel-body">
        <div class="input-group" v-show="showPath">
            <label class="input-group-btn">
                    <span class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp&nbsp{{buttonText}}<input type="file" style="display: none;" @change.prevent="onFileSelect"></span>
            </label>
            <input type="text" class="form-control" readonly value="{{ fileName }}">
        </div>
        <span class="btn btn-primary btn-file" v-show="!showPath">
            <i class="fa fa-upload" aria-hidden="true"></i>{{buttonText}} <input type="file" @change="onFileSelect">
        </span>

        <div class="loader" v-show="showLoader">
            <i class="fa fa-cog fa-spin fa-3x fa-fw loader" v-if="showLoader"></i>
        </div>
        </div>
        <div v-bind:style="{height:tableHeight}" style="overflow: auto; padding:1em" v-show="showTable" >
            <table class="table table-striped thead-inverse header-fixed">
                <thead>
                <tr>
                    <th v-for="cell in header">{{cell}}</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="row in rows">
                        <td v-for="cell in row">{{cell}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    //var Papa = require('papaparse');
    import Papa from "papaparse";
    export default {
        data() {
            return {
                fileName: 'No file loaded.',
                header: [''],
                rows: [''],
            }
        },
        components: {
        },
        props: {
            buttonText: {
                type: String,
                default: 'Browse'
            },
            showPath: {
                type: Boolean,
                default: true
            },
            showLoader: {
                type: Boolean,
                default: false
            },
            showTable: {
                type: Boolean,
                default: false
            },
            tableHeight: {
                type: String,
                default: '40em'
            }
        },
        methods: {
          onFileSelect: function (e) {
              let file = e.target.files[0];
              if(!file) {return}
              this.showTable = false;
              this.showLoader = true;
              this.fileName = file.name;
//              var self = this;
//              Papa.parse(file, {
//                  complete: function(results) {
//                      self.header = results.data.shift();
//                      self.rows = results.data;
//                  }.bind(this)
//              });
              Papa.parse(file, {
                 complete: results => {
                            this.header = results.data.shift();
                            this.rows = results.data;
                      }
              });
          }
        },
        watch: { // This hook is run after the DOM is rendered
            'rows': function (val, oldVal) {
                this.showLoader = false;
                this.showTable = true;
            }
        },
        ready: function () {

        }

    };
</script>

<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    .table {
        margin-top: 1em;
        overflow: auto;
        max-height: 10em;
    }
    .loader {
        margin: 1em;
        text-align: center;
    }
</style>