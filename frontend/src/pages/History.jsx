import { useEffect, useState } from "react";
import { getPredictions } from "../api/predictionApi";
import HistoryTable from "../components/HistoryTable";

export default function History() {
  const [data, setData] = useState([]);

  useEffect(() => {
    getPredictions().then((res) => setData(res.data.data));
  }, []);

  return (
    <div>
      <h2>Prediction History</h2>
      <HistoryTable data={data} />
    </div>
  );
}
