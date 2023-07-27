<template>
  <div>
    <v-dialog v-model="showDialog" max-width="600" style="border-radius: 15px">
      <v-card>
        <v-card-text>
          <v-container fluid style="height: 640px; overflow-y: auto">
            <v-card-text>
              <p>Report video</p>
            </v-card-text>
            <hr />
            <v-radio-group
              v-model="selected"
              column
              v-on:change="selectedItem = 'Choose One'"
              v-if="!showReport"
            >
              <template v-for="(item, index) in itemsWithValues" :key="index">
                <v-radio :label="item.label" :value="item.value"></v-radio>
                <v-select
                  v-model="selectedItem"
                  v-if="
                    selected === item.value &&
                    item.value != 6 &&
                    item.value != 7 &&
                    item.value != 8
                  "
                  :items="items[item.value]"
                  outlined
                  v-bind:key="item.value"
                ></v-select>
              </template>
            </v-radio-group>
            <v-card-text v-if="selected && !showReport">
              <v-checkbox
                v-model="isChecked"
                label="This applies to links within the video description"
                v-if="selected"
              ></v-checkbox>
            </v-card-text>
            <v-card-text-report v-if="showReport">
              <p style="margin-top: 10px">Timestamp selected *</p>
              <input type="time" v-model="timestamp" />
              <v-textarea
                :rules="rules"
                label="Provide additional details"
                v-model="inputValue"
                :counter="500"
                style="margin-top: 20px"
                :counter-value="inputCount"
              ></v-textarea>
            </v-card-text-report>
            <v-card-text>
              <p style="font-size: small">
                Flagged videos and users are reviewed by YouTube staff 24 hours
                a day, seven days a week to determine whether they violate
                Community Guidelines. Accounts are penalised for Community
                Guidelines violations, and serious or repeated violations can
                lead to account termination.
              </p>
              <a href="#" style="text-decoration: none">Report Channel</a>
            </v-card-text>
          </v-container>
        </v-card-text>
        <hr />
        <v-card-actions
          style="display: flex; justify-content: flex-end; align-item: end"
        >
          <v-btn color="red" text @click="cancel">Cancel</v-btn>
          <v-btn
            color="green"
            text
            @click="next"
            v-if="!showReport"
            :disabled="!isChecked"
            >Next</v-btn
          >
          <v-btn color="green" text @click="reportVideo" v-if="showReport"
            >Report</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="showReportData"
      max-width="600"
      style="border-radius: 15px"
    >
      <v-card>
        <v-card-title>Report Data</v-card-title>
        <v-card-text>
          <p>Selected value: {{ reportData.selected }}</p>
          <p>Selected item: {{ reportData.selectedItem }}</p>
          <p>Timestamp: {{ reportData.timestamp }}</p>
          <p>Input value: {{ reportData.inputValue }}</p>
          <p>Is checkbox checked: {{ reportData.isChecked }}</p>
        </v-card-text>
        <v-card-actions>
          <v-btn color="red" text @click="showReportData = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="showDialogin"
      max-width="600"
      style="border-radius: 15px"
    >
      <v-card>
        <v-card-text>
          <h3>Need to report the video?</h3>
          <p>Sign in to report inappropriate content.</p>
        </v-card-text>
        <v-card-actions>
          <v-btn color="red" text @click="showDialogin = false">Back</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <div v-if="showDialog">
      <label for="reportType">Type of Report:</label>
      <select id="reportType" v-model="selectedItem">
        <option value="spam">Spam</option>
        <option value="inappropriate">Inappropriate</option>
        <option value="other">Other</option>
      </select>

      <label for="reportDetails">Additional Details:</label>
      <textarea id="reportDetails" v-model="inputValue"></textarea>

      <label for="reportContent">Report Content:</label>
      <input type="checkbox" id="reportContent" v-model="isChecked" />

      <button @click="reportVideo">Submit</button>
    </div>
    <div v-if="showReportData">
      <p>Report Submitted:</p>
      <pre>{{ reportData }}</pre>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selected: null,
      selectedItem: "Choose One",
      timestamp: "00:04",
      inputValue: "",
      isChecked: false,
      inputCount: 0,
      showDialog: true,
      showReport: false,
      showReportData: false,
      showDialogin: false,
      items: {
        1: [
          "Choose One",
          "Graphic sexual activity",
          "Nudity",
          "Suggestive, but without nudity",
          "Content involing minors",
          "Abusive title or description",
          "Other sexual content",
        ], // list of items for "Violent or repulsive content"
        2: [
          "Choose One",
          "Adults fighting",
          "Physical attack",
          "Youth violence",
          "Animal abuse",
        ], // list of items for "Violent or repulsive content"
        3: [
          "Choose One",
          "Promotes hatred or violence",
          "Abusing vulnerable individuals",
          "Abusing title or description",
        ], // list of items for "Hateful or abusive content"
        4: [
          "Choose One",
          "This is harassing me",
          "This is harassing someone else",
        ], // list of items for "Harassment or bullying"
        5: [
          "Choose One",
          "Phamaceutical or drug abuse",
          "Abuse of fire or explosives",
          "Suicide or self injury",
          "Other dangerous acts",
        ], // list of items for "Harmful or dangerous acts"
        // "6": ["Choose One", "Item 2", "Item 3"], // list of items for "Misinformation"
        // "7": ["Choose One", "Item 2", "Item 3"], // list of items for "Child abuse"
        // "8": ["Choose One", "Item 2", "Item 3"], // list of items for "Promotes terrorism"
        9: [
          "Choose One",
          "Mass advertising",
          "Pharmaceutical drugs for sale",
          "Misleading text",
          "Misleading thumbnail",
          "Scams or fraud",
        ], // list of items for "Spam or misleading"
        10: [
          "Choose One",
          "Copyright issue",
          "Privacy issue",
          "Trademark infringement",
          "Defamation",
          "Counterfeit",
          "Other legal issue",
        ], // list of items for "Infringes my rights"
        11: [
          "Choose One",
          "Captions are missing (CVAA)",
          "Captions are inaccurate",
          "Captions are abusive",
        ], // list of items for "Captions issue"
      },
      itemsWithValues: [
        { label: "Sexual content", value: "1" },
        { label: "Violent or repulsive content", value: "2" },
        { label: "Hateful or abusive content", value: "3" },
        { label: "Harassment or bullying", value: "4" },
        { label: "Harmful or dangerous acts", value: "5" },
        { label: "Misinformation", value: "6" },
        { label: "Child abuse", value: "7" },
        { label: "Promotes terrorism", value: "8" },
        { label: "Spam or misleading", value: "9" },
        { label: "Infringes my rights", value: "10" },
        { label: "Captions issue", value: "11" },
      ],

      rules: [
        (v) => !!v || "Please enter a description",
        (v) => v.length <= 500 || "Max 500 characters",
      ],
    };
  },
  methods: {
    cancel() {
      this.showDialog = false;
      this.selected = null;
      this.isChecked = false;
      this.inputValue = "";
      this.inputCount = 0;
      this.showReport = false;
    },
    next() {
      this.showReport = true;
    },
    reportVideo() {
      this.showDialog = false;
      this.showReportData = true;
      let token =
        this.$cookies.get("token") !== "undefined" &&
        this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      this.reportData = {
        selected: this.selected,
        selectedItem: this.selectedItem,
        timestamp: this.timestamp,
        inputValue: this.inputValue,
        isChecked: this.isChecked,
      };
      if (token) {
        this.$http
          .post(
            "/reports",
            {
              user_id: 1, // Replace with the actual user ID
              video_id: 1, // Replace with the actual video ID
              comment: this.inputValue,
              type_of_report: this.selectedItem,
              content_video: this.isChecked,
            },
            { headers: { Authorization: `Bearer ${token}` } }
          )
          .then((response) => {
            this.showDialog = false;
            this.showReportData = true;
            this.reportData = response.data;
          })
          .catch((error) => {
            console.error(error.message);
          });
      } else {
        // alert('login pg')
        this.showReportData = false;
        this.showDialogin = true;
      }
    },
  },
};
</script>