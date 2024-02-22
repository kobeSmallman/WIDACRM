import 'bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);





window.FullCalendar = { Calendar, dayGridPlugin, interactionPlugin };
window.Chart = Chart;