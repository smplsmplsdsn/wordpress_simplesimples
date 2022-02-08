/**
 * 年表フォーマットをコーディングする
 *
 * @param (object) st.year, st.month
 * @param (object) ed.year, ed.month
 */
const chronology = (st = {}, ed = {}) => {
  const d = new Date(),
        y = d.getFullYear(),
        m = d.getMonth() + 1;
  
  let t = '',
      i = 0,
      j = 0,
      st_m = 0,
      ed_m = 0;
  
  if (!ed.year) {
    ed.year = d.getFullYear();
  }

  if (!ed.month) {
    ed.month = d.getMonth() + 1;
  }
  
  for (i = st.year; i <= ed.year; i++) {
    st_m = (i === st.year)? st.month: 1;
    ed_m = (i === ed.year)? ed.month: 12;
        
    for (j = st_m; j <= ed_m; j++) {
      chronologyCording(i, j, j === st_m);
    }
  }  
}