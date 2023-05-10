--
-- Table structure for table `patient_diagnostic`
--

CREATE TABLE `patient_examen` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(60) NOT NULL,
  `cmnd` varchar(17) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `visit_date` date NOT NULL,
  `weight` varchar(12) NOT NULL,
  `patient_diagnostic_id` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `chandoan` varchar(100) NOT NULL,
  `lamsang` varchar(100) NOT NULL,
  `gan` varchar(100) NOT NULL,
  `duongmat` varchar(100) NOT NULL,
  `ongmatchu` varchar(100) NOT NULL,
  `tuimat` varchar(100) NOT NULL,
  `thantrai` varchar(100) NOT NULL,
  `thanphai` varchar(100) NOT NULL,
  `tuy` varchar(100) NOT NULL,
  `lach` varchar(100) NOT NULL,
  `bangquang` varchar(100) NOT NULL,
  `tuicung` varchar(100) NOT NULL,
  `tucung` varchar(100) NOT NULL,
  `buongtrungtrai` varchar(100) NOT NULL,
  `buongtrungphai` varchar(100) NOT NULL,
  `ghinhankhac` varchar(100) NOT NULL,
  `hinhanhsieuam` LONGBLOB NOT NULL,
  `ketluan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Indexes for table `patient_visits`
--
ALTER TABLE `patient_examen`
  ADD PRIMARY KEY (`id`);

  
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patient_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  