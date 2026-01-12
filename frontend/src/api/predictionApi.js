import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8000/api",
});

export const createPrediction = (base64Image) =>
  api.post("/predictions", { image: base64Image });

export const getPredictions = () =>
  api.get("/predictions");

export const getStatistics = () =>
  api.get("/predictions/statistics");