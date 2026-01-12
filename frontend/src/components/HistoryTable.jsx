export default function HistoryTable({ data }) {
  return (
    <div className="table-responsive">
      <table className="table table-bordered table-hover">
        <thead className="table-dark">
          <tr>
            <th>Class</th>
            <th>Category</th>
            <th>Confidence</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr key={item.id}>
              <td>{item.predicted_class}</td>
              <td>{item.category}</td>
              <td>{item.confidence_percent}</td>
              <td>{item.created_at}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
