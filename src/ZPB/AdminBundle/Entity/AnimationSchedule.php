<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnimationSchedule
 *
 * @ORM\Table(name="zpb_animations_schedules")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimationScheduleRepository")
 */
class AnimationSchedule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timetable", type="time")
     */
    private $timetable;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Animation", inversedBy="schedules")
     * @ORM\JoinColumn(name="animation_id", referencedColumnName="id")
     */
    private $animation;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\AnimationDay", inversedBy="schedules")
     * @ORM\JoinColumn(name="animations_days_id", referencedColumnName="id")
     */
    private $animationDay;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set timetable
     *
     * @param \DateTime $timetable
     * @return AnimationSchedule
     */
    public function setTimetable($timetable)
    {
        $this->timetable = $timetable;

        return $this;
    }

    /**
     * Get timetable
     *
     * @return \DateTime 
     */
    public function getTimetable()
    {
        return $this->timetable;
    }
}
