import { useEffect, useState } from "react";
import { getStatistics } from "../api/predictionApi";
import StatsCard from "../components/StatsCard";

export default function Statistics() {
  const [stats, setStats] = useState(null);

  useEffect(() => {
    getStatistics().then((res) => setStats(res.data.data));
  }, []);

  if (!stats) return null;

  return (
    <>
      <h2 className="mb-4">Statistics</h2>
      <div className="row">
        <StatsCard title="Total Predictions" value={stats.total_predictions} />
        <StatsCard title="Organik" value={stats.total_organik} />
        <StatsCard title="Anorganik" value={stats.total_anorganik} />
        <StatsCard
          title="Avg Confidence"
          value={(stats.average_confidence * 100).toFixed(2) + "%"}
        />
      </div>
    </>
  );
}
