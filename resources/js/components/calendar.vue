<template>
  <div id="app">
    <kalendar :configuration="calendar_settings" :events="events"/>
  </div>
</template>

<script>
import { Kalendar } from "kalendar-vue";
import 'kalendar-vue/dist/kalendar-vue.css';

export default {
  name: "App",

  data: () => ({
  events: [],
  calendar_settings: {
    style: 'material_design',
    view_type: 'week',
    cell_height: 20,
    scrollToNow: true,
    current_day: new Date(),
    read_only: false,
    day_starts_at: 0,
    day_ends_at: 24,
    overlap: true,
    hide_dates: ['2019-10-31'], // Spooky
    hide_days: [6],
    past_event_creation: true
  },
  new_appointment: {
    title: null,
    description: null
  }
}),
// addEvent(popup_data, form_data) {
//   let payload = {
//     data: {
//       title: this.new_appointment.title,
//       description: this.new_appointment.description,
//     },
//     from: popup_info.start_time,
//     to: popup_info.end_time,
//   };

//   this.$kalendar.addNewEvent(
//     payload,
//   );
//   this.$kalendar.closePopups();
//   this.clearFormData();
// },

// // Remove Event
// removeEvent(kalendarEvent) {
//   let day = kalendarEvent.start_time.slice(0, 10);
//   this.$kalendar.removeEvent({
//     day,
//     key: kalendarEvent.key,
//     id: kalendarEvent.kalendar_id,
//   })
// },
  components: {
    Kalendar
  },
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
