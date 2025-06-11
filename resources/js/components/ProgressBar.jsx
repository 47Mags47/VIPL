export default function ProgressBar({ progress }) {
    const percentage = (progress * 100).toFixed(1).replace(/\.0$/, '');
  
  return (
    <div className="progress-container">
      <span className="progress-text">{percentage}%</span>
      <div className="progress-track">
        <div 
          className="progress-fill"
          style={{ width: `${percentage}%` }}
        />
      </div>
    </div>
  );
}