export default function StatsCard({ title, value }) {
  return (
    <div className="col-md-3 mb-3">
      <div className="card text-center shadow-sm">
        <div className="card-body">
          <h6 className="card-title">{title}</h6>
          <h4>{value}</h4>
        </div>
      </div>
    </div>
  );
}
