import './bootstrap';
import flatpickr from 'flatpickr';
import { Indonesian } from 'flatpickr/dist/l10n/id.js';
import tinymce from 'tinymce';
import 'tinymce/themes/silver';
import 'tinymce/models/dom';
import 'tinymce/icons/default';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/autolink';

window.flatpickr = flatpickr;
window.flatpickrLocaleId = Indonesian;
window.tinymce = tinymce;