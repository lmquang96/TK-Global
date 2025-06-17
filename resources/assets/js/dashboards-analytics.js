/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, legendColor, labelColor, shadeColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  legendColor = config.colors.bodyColor;
  labelColor = config.colors.textMuted;
  borderColor = config.colors.borderColor;

  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
    totalRevenueChartOptions = {
      series: [
        {
          name: new Date().getFullYear() - 1,

          data: [18, 7, 15, 29, 18, 12, 9]
        },
        {
          name: new Date().getFullYear() - 2,
          data: [-13, -18, -9, -14, -5, -17, -15]
        }
      ],
      chart: {
        height: 317,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '30%',
          borderRadius: 8,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -5
        },
        fontSize: '13px',
        fontFamily: 'Public Sans',
        fontWeight: 400,
        labels: {
          colors: legendColor,
          useSeriesColors: false
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        strokeDashArray: 7,
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      fill: {
        opacity: [1, 1]
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        labels: {
          style: {
            fontSize: '13px',
            fontFamily: 'Public Sans',
            colors: labelColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            fontFamily: 'Public Sans',
            colors: labelColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 12,
                columnWidth: '43%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 12,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 12,
                columnWidth: '33%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '38%'
              }
            }
          }
        },
        {
          breakpoint: 440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '50%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 9,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
    totalRevenueChart.render();
  }

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector('#growthChart'),
    growthChartOptions = {
      series: [78],
      labels: ['Tăng trưởng'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: legendColor,
              fontSize: '15px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // Profit Report Line Chart
  // --------------------------------------------------------------------
  $.ajax({
    type: 'GET',
    url: '/click-chart',
    data: {},
    success: function (response) {
      if (response.status && response.status == 200) {
        let dataY = Object.values(response.data).map(num => +num);
        let maxY = Math.max(...dataY);
        const profileReportChartEl = document.querySelector('#profileReportChart'),
          profileReportChartConfig = {
            series: [
              {
                name: 'Lượt click',
                data: Object.values(response.data)
              }
            ],
            tooltip: {
              y: {
                formatter: function (value) {
                  return value.toLocaleString('vi-VN');
                }
              }
            },
            chart: {
              height: 175,
              parentHeightOffset: 0,
              parentWidthOffset: 0,
              toolbar: {
                show: false
              },
              type: 'area'
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              width: 3,
              curve: 'smooth'
            },
            legend: {
              show: false
            },
            markers: {
              size: 6,
              colors: 'transparent',
              strokeColors: 'transparent',
              strokeWidth: 4,
              discrete: [
                {
                  fillColor: config.colors.white,
                  seriesIndex: 0,
                  dataPointIndex: 6,
                  strokeColor: config.colors.warning,
                  strokeWidth: 2,
                  size: 6,
                  radius: 8
                }
              ],
              hover: {
                size: 7
              }
            },
            colors: [config.colors.warning],
            fill: {
              type: 'gradient',
              gradient: {
                shade: shadeColor,
                shadeIntensity: 0.6,
                opacityFrom: 0.5,
                opacityTo: 0.25,
                stops: [0, 95, 100]
              }
            },
            grid: {
              show: true,
              borderColor: borderColor,
              strokeDashArray: 8,
              padding: {
                top: -20,
                bottom: 10,
                left: 0,
                right: 8
              }
            },
            xaxis: {
              categories: Object.keys(response.data),
              axisBorder: {
                show: false
              },
              axisTicks: {
                show: false
              },
              labels: {
                show: true,
                style: {
                  fontSize: '13px',
                  colors: labelColor
                }
              }
            },
            yaxis: {
              labels: {
                show: false,
                style: {
                  fontSize: '13px',
                  colors: labelColor
                }
              },
              min: 0,
              max: maxY,
              tickAmount: 4,
              forceNiceScale: true
            }
          };
        if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
          const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
          profileReportChart.render();
        }
      }
    }
  });

  // Order Statistics Chart
  // --------------------------------------------------------------------
  const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
    orderChartConfig = {
      chart: {
        height: 145,
        width: 110,
        type: 'donut'
      },
      labels: ['Electronic', 'Sports', 'Decor', 'Fashion'],
      series: [50, 85, 25, 40],
      colors: [config.colors.success, config.colors.primary, config.colors.secondary, config.colors.info],
      stroke: {
        width: 5,
        colors: [cardColor]
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      states: {
        hover: {
          filter: { type: 'none' }
        },
        active: {
          filter: { type: 'none' }
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '18px',
                fontFamily: 'Public Sans',
                fontWeight: 500,
                color: headingColor,
                offsetY: -17,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 17,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '13px',
                color: legendColor,
                label: 'Weekly',
                formatter: function (w) {
                  return '38%';
                }
              }
            }
          }
        }
      }
    };
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
    statisticsChart.render();
  }

  // Income Chart - Area chart
  // --------------------------------------------------------------------
  // const incomeChartEl = document.querySelector('#incomeChart'),
  //   incomeChartConfig = {
  //     series: [
  //       {
  //         data: [21, 30, 22, 42, 26, 35, 29]
  //       }
  //     ],
  //     chart: {
  //       height: 232,
  //       parentHeightOffset: 0,
  //       parentWidthOffset: 0,
  //       toolbar: {
  //         show: false
  //       },
  //       type: 'area'
  //     },
  //     dataLabels: {
  //       enabled: false
  //     },
  //     stroke: {
  //       width: 3,
  //       curve: 'smooth'
  //     },
  //     legend: {
  //       show: false
  //     },
  //     markers: {
  //       size: 6,
  //       colors: 'transparent',
  //       strokeColors: 'transparent',
  //       strokeWidth: 4,
  //       discrete: [
  //         {
  //           fillColor: config.colors.white,
  //           seriesIndex: 0,
  //           dataPointIndex: 6,
  //           strokeColor: config.colors.primary,
  //           strokeWidth: 2,
  //           size: 6,
  //           radius: 8
  //         }
  //       ],
  //       hover: {
  //         size: 7
  //       }
  //     },
  //     colors: [config.colors.primary],
  //     fill: {
  //       type: 'gradient',
  //       gradient: {
  //         shade: shadeColor,
  //         shadeIntensity: 0.6,
  //         opacityFrom: 0.5,
  //         opacityTo: 0.25,
  //         stops: [0, 95, 100]
  //       }
  //     },
  //     grid: {
  //       borderColor: borderColor,
  //       strokeDashArray: 8,
  //       padding: {
  //         top: -20,
  //         bottom: 10,
  //         left: 20,
  //         right: 8
  //       }
  //     },
  //     xaxis: {
  //       categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
  //       axisBorder: {
  //         show: false
  //       },
  //       axisTicks: {
  //         show: false
  //       },
  //       labels: {
  //         show: true,
  //         style: {
  //           fontSize: '13px',
  //           colors: labelColor
  //         }
  //       }
  //     },
  //     yaxis: {
  //       labels: {
  //         show: true,
  //         style: {
  //           fontSize: '13px',
  //           colors: labelColor
  //         }
  //       },
  //       min: 10,
  //       max: 50,
  //       tickAmount: 4
  //     }
  //   };
  // if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
  //   const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
  //   incomeChart.render();
  // }

  $.ajax({
    type: 'GET',
    url: '/data-chart',
    data: {},
    success: function (response) {
      if (response.status && response.status == 200) {
        let dataY = Object.values(response.data).map(num => +num);
        let maxY = Math.max(...dataY);
        const incomeChartEl = document.querySelector('#incomeChart'),
          incomeChartConfig = {
            series: [
              {
                name: 'Hoa hồng phát sinh',
                data: Object.values(response.data)
              }
            ],
            tooltip: {
              y: {
                formatter: function (value) {
                  return value.toLocaleString('vi-VN') + '₫';
                }
              }
            },
            chart: {
              height: 232,
              parentHeightOffset: 0,
              parentWidthOffset: 0,
              toolbar: {
                show: false
              },
              type: 'area'
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              width: 3,
              curve: 'smooth'
            },
            legend: {
              show: false
            },
            markers: {
              size: 6,
              colors: 'transparent',
              strokeColors: 'transparent',
              strokeWidth: 4,
              discrete: [
                {
                  fillColor: config.colors.white,
                  seriesIndex: 0,
                  dataPointIndex: 7,
                  strokeColor: config.colors.primary,
                  strokeWidth: 2,
                  size: 6,
                  radius: 8
                }
              ],
              hover: {
                size: 7
              }
            },
            colors: [config.colors.primary],
            fill: {
              type: 'gradient',
              gradient: {
                shade: shadeColor,
                shadeIntensity: 0.6,
                opacityFrom: 0.5,
                opacityTo: 0.25,
                stops: [0, 95, 100]
              }
            },
            grid: {
              borderColor: borderColor,
              strokeDashArray: 8,
              padding: {
                top: -20,
                bottom: 10,
                left: 20,
                right: 8
              }
            },
            xaxis: {
              categories: Object.keys(response.data),
              axisBorder: {
                show: false
              },
              axisTicks: {
                show: false
              },
              labels: {
                show: true,
                style: {
                  fontSize: '13px',
                  colors: labelColor
                }
              }
            },
            yaxis: {
              labels: {
                show: true,
                style: {
                  fontSize: '13px',
                  colors: labelColor
                },
                formatter: function (value) {
                  return value.toLocaleString('vi-VN') + ' ₫'; // Hiển thị 2 chữ số thập phân + đơn vị
                }
              },
              min: 0,
              max: maxY,
              tickAmount: 4,
              forceNiceScale: true
            }
          };
        if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
          const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
          incomeChart.render();
        }
      }
    }
  });

  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: '8',
          hollow: {
            margin: 2,
            size: '40%'
          },
          track: {
            background: borderColor
          },
          dataLabels: {
            show: true,
            name: {
              show: false
            },
            value: {
              formatter: function (val) {
                return '' + parseInt(val) + '%';
              },
              offsetY: 5,
              color: legendColor,
              fontSize: '12px',
              fontFamily: 'Public Sans',
              show: true
            }
          }
        }
      },
      fill: {
        type: 'solid',
        colors: config.colors.primary
      },
      stroke: {
        lineCap: 'round'
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
    weeklyExpenses.render();
  }
})();
